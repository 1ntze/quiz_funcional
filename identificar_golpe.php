<?php
session_start();

/*
    Página: classificar_golpe.php
    Agora com integração de XP.

    Compatível com:
    - testeconexao.php usando $conn (mysqli)
    - includes/db.php usando $pdo (PDO) ou $conn (mysqli)
    - xp.php (opcional, se existir no projeto)

    Regra aplicada:
    - cada acerto = 10 pontos e 10 XP
    - erro = 0 XP
    - o XP é salvo na tabela usuarios.xp_total
    - o nível é recalculado automaticamente (1 nível a cada 100 XP)
*/

$carregouConexao = false;
if (file_exists(__DIR__ . '/testeconexao.php')) {
    require_once __DIR__ . '/testeconexao.php';
    $carregouConexao = true;
}
if (!$carregouConexao && file_exists(__DIR__ . '/includes/db.php')) {
    require_once __DIR__ . '/includes/db.php';
    $carregouConexao = true;
}
if (file_exists(__DIR__ . '/xp.php')) {
    require_once __DIR__ . '/xp.php';
}

function getDbAdapter(): string
{
    global $conn, $pdo;

    if (isset($conn) && $conn instanceof mysqli) {
        return 'mysqli';
    }

    if (isset($pdo) && $pdo instanceof PDO) {
        return 'pdo';
    }

    throw new RuntimeException('Conexão com o banco não encontrada. Verifique testeconexao.php ou includes/db.php.');
}

function inferMysqliTypes(array $params): string
{
    $types = '';

    foreach ($params as $param) {
        if (is_int($param)) {
            $types .= 'i';
        } elseif (is_float($param)) {
            $types .= 'd';
        } else {
            $types .= 's';
        }
    }

    return $types;
}

function dbSelectAll(string $sql, array $params = []): array
{
    global $conn, $pdo;

    $adapter = getDbAdapter();

    if ($adapter === 'mysqli') {
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new RuntimeException('Erro ao preparar query: ' . $conn->error);
        }

        if (!empty($params)) {
            $types = inferMysqliTypes($params);
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new RuntimeException('Erro ao executar query: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();
        return $rows;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function dbSelectOne(string $sql, array $params = []): ?array
{
    $rows = dbSelectAll($sql, $params);
    return $rows[0] ?? null;
}

function dbExecute(string $sql, array $params = []): bool
{
    global $conn, $pdo;

    $adapter = getDbAdapter();

    if ($adapter === 'mysqli') {
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new RuntimeException('Erro ao preparar query: ' . $conn->error);
        }

        if (!empty($params)) {
            $types = inferMysqliTypes($params);
            $stmt->bind_param($types, ...$params);
        }

        $ok = $stmt->execute();
        if (!$ok) {
            throw new RuntimeException('Erro ao executar query: ' . $stmt->error);
        }

        $stmt->close();
        return true;
    }

    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

function tabelaExiste(string $nomeTabela): bool
{
    try {
        $row = dbSelectOne('SHOW TABLES LIKE ?', [$nomeTabela]);
        return $row !== null;
    } catch (Throwable $e) {
        return false;
    }
}

function colunaExiste(string $tabela, string $coluna): bool
{
    try {
        $row = dbSelectOne("SHOW COLUMNS FROM `{$tabela}` LIKE ?", [$coluna]);
        return $row !== null;
    } catch (Throwable $e) {
        return false;
    }
}

function buscarIdsCartasAtivas(): array
{
    $rows = dbSelectAll('SELECT id_carta FROM cartas_classificacao WHERE ativo = 1 ORDER BY RAND()');
    return array_map(static fn($row) => (int)$row['id_carta'], $rows);
}

function buscarCartaPorId(int $idCarta): ?array
{
    return dbSelectOne(
        'SELECT id_carta, titulo, descricao, tipo, resposta_correta, explicacao
         FROM cartas_classificacao
         WHERE id_carta = ? AND ativo = 1
         LIMIT 1',
        [$idCarta]
    );
}

function getUsuarioLogadoId(): ?int
{
    $candidatos = [
        $_SESSION['user']['id_usuario'] ?? null,
        $_SESSION['user']['id'] ?? null,
        $_SESSION['usuario']['id_usuario'] ?? null,
        $_SESSION['usuario']['id'] ?? null,
        $_SESSION['id_usuario'] ?? null,
        $_SESSION['usuario_id'] ?? null,
        $_SESSION['id'] ?? null,
    ];

    foreach ($candidatos as $valor) {
        if ($valor !== null && $valor !== '' && is_numeric($valor)) {
            return (int)$valor;
        }
    }

    return null;
}

function calcularNivelPorXp(int $xp): int
{
    return max(1, (int)floor($xp / 100) + 1);
}

function buscarResumoUsuario(?int $idUsuario): ?array
{
    if (!$idUsuario || !tabelaExiste('usuarios')) {
        return null;
    }

    $colNome = colunaExiste('usuarios', 'nome') ? 'nome' : (colunaExiste('usuarios', 'usu_nome') ? 'usu_nome AS nome' : 'NULL AS nome');
    $colXp = colunaExiste('usuarios', 'xp_total') ? 'xp_total' : (colunaExiste('usuarios', 'xp') ? 'xp AS xp_total' : '0 AS xp_total');
    $colNivel = colunaExiste('usuarios', 'nivel') ? 'nivel' : (colunaExiste('usuarios', 'nivel_atual') ? 'nivel_atual AS nivel' : '1 AS nivel');

    return dbSelectOne(
        "SELECT id_usuario, {$colNome}, {$colXp}, {$colNivel}
         FROM usuarios
         WHERE id_usuario = ?
         LIMIT 1",
        [$idUsuario]
    );
}

function atualizarSessaoUsuarioXpNivel(int $xpTotal, int $nivel): void
{
    if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
        $_SESSION['user']['xp_total'] = $xpTotal;
        $_SESSION['user']['nivel'] = $nivel;
    }

    if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $_SESSION['usuario']['xp_total'] = $xpTotal;
        $_SESSION['usuario']['nivel'] = $nivel;
    }

    $_SESSION['xp_total'] = $xpTotal;
    $_SESSION['nivel'] = $nivel;
}

function adicionarXpAoUsuario(int $idUsuario, int $xpGanho): ?array
{
    if ($xpGanho <= 0 || !tabelaExiste('usuarios')) {
        return null;
    }

    $usuarioAntes = buscarResumoUsuario($idUsuario);
    if (!$usuarioAntes) {
        return null;
    }

    $xpAntes = (int)($usuarioAntes['xp_total'] ?? 0);
    $nivelAntes = (int)($usuarioAntes['nivel'] ?? calcularNivelPorXp($xpAntes));

    $atualizou = false;

    if (function_exists('adicionarXP')) {
        try {
            global $conn, $pdo;

            if (isset($conn)) {
                adicionarXP($conn, $idUsuario, $xpGanho);
                $atualizou = true;
            } elseif (isset($pdo)) {
                adicionarXP($pdo, $idUsuario, $xpGanho);
                $atualizou = true;
            }
        } catch (Throwable $e) {
            $atualizou = false;
        }
    }

    if (!$atualizou) {
        $colXp = colunaExiste('usuarios', 'xp_total') ? 'xp_total' : (colunaExiste('usuarios', 'xp') ? 'xp' : null);
        $colNivel = colunaExiste('usuarios', 'nivel') ? 'nivel' : (colunaExiste('usuarios', 'nivel_atual') ? 'nivel_atual' : null);

        if (!$colXp) {
            return null;
        }

        $xpDepois = $xpAntes + $xpGanho;
        $nivelDepois = calcularNivelPorXp($xpDepois);

        if ($colNivel) {
            dbExecute(
                "UPDATE usuarios
                 SET {$colXp} = ?, {$colNivel} = ?
                 WHERE id_usuario = ?",
                [$xpDepois, $nivelDepois, $idUsuario]
            );
        } else {
            dbExecute(
                "UPDATE usuarios
                 SET {$colXp} = ?
                 WHERE id_usuario = ?",
                [$xpDepois, $idUsuario]
            );
        }
    }

    $usuarioDepois = buscarResumoUsuario($idUsuario);
    if (!$usuarioDepois) {
        return null;
    }

    $xpDepois = (int)($usuarioDepois['xp_total'] ?? ($xpAntes + $xpGanho));
    $nivelDepois = (int)($usuarioDepois['nivel'] ?? calcularNivelPorXp($xpDepois));

    atualizarSessaoUsuarioXpNivel($xpDepois, $nivelDepois);

    return [
        'xp_ganho' => $xpDepois - $xpAntes,
        'xp_antes' => $xpAntes,
        'xp_depois' => $xpDepois,
        'nivel_antes' => $nivelAntes,
        'nivel_depois' => $nivelDepois,
        'subiu_nivel' => $nivelDepois > $nivelAntes,
    ];
}

function iniciarNovoJogo(): void
{
    $ids = buscarIdsCartasAtivas();

    $_SESSION['classifica_ids'] = $ids;
    $_SESSION['classifica_indice'] = 0;
    $_SESSION['classifica_pontos'] = 0;
    $_SESSION['classifica_acertos'] = 0;
    $_SESSION['classifica_erros'] = 0;
    $_SESSION['classifica_xp_ganho'] = 0;
    $_SESSION['classifica_flash'] = null;
    $_SESSION['classifica_resultado_salvo'] = false;
}

function limparFlash(): ?array
{
    $flash = $_SESSION['classifica_flash'] ?? null;
    unset($_SESSION['classifica_flash']);
    return $flash;
}

function iconeTipo(string $tipo): string
{
    return match ($tipo) {
        'email' => '✉️ E-mail',
        'sms' => '📱 SMS',
        'site' => '🌐 Site',
        'ligacao' => '📞 Ligação',
        'anuncio' => '🛒 Anúncio',
        default => '🧩 Situação',
    };
}

function textoFaixaResultado(float $percentual): string
{
    if ($percentual >= 80) {
        return 'Excelente! Você identificou muito bem os sinais de golpe.';
    }

    if ($percentual >= 50) {
        return 'Bom resultado. Você já percebe vários sinais, mas ainda vale revisar alguns casos.';
    }

    return 'Atenção. Vale treinar mais para identificar golpes com mais segurança.';
}

function salvarResultadoFinalSePossivel(): void
{
    if (!isset($_SESSION['classifica_ids']) || ($_SESSION['classifica_resultado_salvo'] ?? false) === true) {
        return;
    }

    $total = count($_SESSION['classifica_ids']);
    if ($total <= 0) {
        return;
    }

    try {
        if (!tabelaExiste('partidas_classificacao')) {
            return;
        }

        $idUsuario = getUsuarioLogadoId();

        dbExecute(
            'INSERT INTO partidas_classificacao (id_usuario, pontos, total_cartas, acertos, erros, data_partida)
             VALUES (?, ?, ?, ?, ?, NOW())',
            [
                $idUsuario,
                (int)($_SESSION['classifica_pontos'] ?? 0),
                $total,
                (int)($_SESSION['classifica_acertos'] ?? 0),
                (int)($_SESSION['classifica_erros'] ?? 0),
            ]
        );

        $_SESSION['classifica_resultado_salvo'] = true;
    } catch (Throwable $e) {
        // Se a tabela não existir ou der algum erro, o jogo continua normalmente.
    }
}

$erroPagina = null;
$usuarioLogado = null;
$xpTotalUsuario = null;
$nivelUsuario = null;
$debugXp = [];

try {
    if (isset($_GET['reiniciar'])) {
        iniciarNovoJogo();
        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
        exit;
    }

    if (!isset($_SESSION['classifica_ids']) || !is_array($_SESSION['classifica_ids'])) {
        iniciarNovoJogo();
    }

    $idUsuarioLogado = getUsuarioLogadoId();
    $debugXp['id_detectado_inicio'] = $idUsuarioLogado;
    $usuarioLogado = buscarResumoUsuario($idUsuarioLogado);
    if ($usuarioLogado) {
        $xpTotalUsuario = (int)($usuarioLogado['xp_total'] ?? 0);
        $nivelUsuario = (int)($usuarioLogado['nivel'] ?? calcularNivelPorXp($xpTotalUsuario));
    }

    $idsCartas = $_SESSION['classifica_ids'] ?? [];
    $indiceAtual = (int)($_SESSION['classifica_indice'] ?? 0);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
        $respostaUsuario = trim((string)$_POST['resposta']);
        $respostasValidas = ['seguro', 'suspeito', 'golpe'];

        if (in_array($respostaUsuario, $respostasValidas, true) && isset($idsCartas[$indiceAtual])) {
            $cartaAtual = buscarCartaPorId((int)$idsCartas[$indiceAtual]);

            if ($cartaAtual) {
                $acertou = $respostaUsuario === $cartaAtual['resposta_correta'];
                $xpGanhoRodada = 0;
                $resultadoXp = null;

                if ($acertou) {
                    $_SESSION['classifica_pontos'] = (int)($_SESSION['classifica_pontos'] ?? 0) + 10;
                    $_SESSION['classifica_acertos'] = (int)($_SESSION['classifica_acertos'] ?? 0) + 1;
                    $_SESSION['classifica_xp_ganho'] = (int)($_SESSION['classifica_xp_ganho'] ?? 0) + 10;
                    $xpGanhoRodada = 10;

                    if ($idUsuarioLogado) {
                        $resultadoXp = adicionarXpAoUsuario($idUsuarioLogado, $xpGanhoRodada);
                        $debugXp['resultado_xp_post'] = $resultadoXp;
                    } else {
                        $debugXp['resultado_xp_post'] = 'Usuário não identificado na sessão';
                    }
                } else {
                    $_SESSION['classifica_erros'] = (int)($_SESSION['classifica_erros'] ?? 0) + 1;
                }

                $_SESSION['classifica_flash'] = [
                    'acertou' => $acertou,
                    'titulo' => $cartaAtual['titulo'],
                    'resposta_usuario' => $respostaUsuario,
                    'resposta_correta' => $cartaAtual['resposta_correta'],
                    'explicacao' => $cartaAtual['explicacao'],
                    'xp_ganho' => $xpGanhoRodada,
                    'xp_total' => $resultadoXp['xp_depois'] ?? null,
                    'nivel_depois' => $resultadoXp['nivel_depois'] ?? null,
                    'subiu_nivel' => $resultadoXp['subiu_nivel'] ?? false,
                    'debug_xp' => $debugXp['resultado_xp_post'] ?? null,
                    'id_usuario_detectado' => $idUsuarioLogado ?? null,
                ];

                $_SESSION['classifica_indice'] = $indiceAtual + 1;
            }
        }

        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
        exit;
    }

    $flash = limparFlash();

    $idUsuarioLogado = getUsuarioLogadoId();
    $debugXp['id_detectado_inicio'] = $idUsuarioLogado;
    $usuarioLogado = buscarResumoUsuario($idUsuarioLogado);
    if ($usuarioLogado) {
        $xpTotalUsuario = (int)($usuarioLogado['xp_total'] ?? 0);
        $nivelUsuario = (int)($usuarioLogado['nivel'] ?? calcularNivelPorXp($xpTotalUsuario));
    }

    $idsCartas = $_SESSION['classifica_ids'] ?? [];
    $indiceAtual = (int)($_SESSION['classifica_indice'] ?? 0);
    $pontos = (int)($_SESSION['classifica_pontos'] ?? 0);
    $acertos = (int)($_SESSION['classifica_acertos'] ?? 0);
    $erros = (int)($_SESSION['classifica_erros'] ?? 0);
    $xpPartida = (int)($_SESSION['classifica_xp_ganho'] ?? 0);
    $totalCartas = count($idsCartas);

    $jogoFinalizado = $totalCartas === 0 || $indiceAtual >= $totalCartas;
    $carta = null;

    if (!$jogoFinalizado && isset($idsCartas[$indiceAtual])) {
        $carta = buscarCartaPorId((int)$idsCartas[$indiceAtual]);

        if (!$carta) {
            $_SESSION['classifica_indice'] = $indiceAtual + 1;
            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
            exit;
        }
    } else {
        salvarResultadoFinalSePossivel();
    }
} catch (Throwable $e) {
    $erroPagina = $e->getMessage();
    $flash = null;
    $pontos = 0;
    $acertos = 0;
    $erros = 0;
    $xpPartida = 0;
    $totalCartas = 0;
    $indiceAtual = 0;
    $jogoFinalizado = false;
    $carta = null;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifique o Golpe</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a, #111827, #1e293b);
            color: #f8fafc;
            padding: 24px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .topo {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            margin-bottom: 22px;
        }

        .titulo-area h1 {
            font-size: 2rem;
            margin-bottom: 6px;
        }

        .titulo-area p {
            color: #cbd5e1;
            font-size: 0.98rem;
        }

        .acoes-topo {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-topo {
            text-decoration: none;
            color: #fff;
            background: rgba(59,130,246,.18);
            border: 1px solid rgba(96,165,250,.45);
            padding: 10px 14px;
            border-radius: 12px;
            transition: .2s ease;
        }

        .btn-topo:hover {
            transform: translateY(-1px);
            background: rgba(59,130,246,.28);
        }

        .painel {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .card-info {
            background: rgba(15,23,42,.78);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 14px 30px rgba(0,0,0,.18);
        }

        .card-info span {
            display: block;
            color: #93c5fd;
            font-size: .88rem;
            margin-bottom: 6px;
        }

        .card-info strong {
            font-size: 1.45rem;
        }

        .alerta {
            margin-bottom: 18px;
            padding: 16px 18px;
            border-radius: 16px;
            border: 1px solid transparent;
            line-height: 1.6;
        }

        .alerta strong {
            display: block;
            margin-bottom: 8px;
        }

        .alerta.ok {
            background: rgba(34,197,94,.14);
            border-color: rgba(34,197,94,.4);
        }

        .alerta.erro {
            background: rgba(239,68,68,.14);
            border-color: rgba(239,68,68,.4);
        }

        .alerta.sistema {
            background: rgba(251,191,36,.14);
            border-color: rgba(251,191,36,.4);
        }

        .alerta.info {
            background: rgba(59,130,246,.14);
            border-color: rgba(96,165,250,.35);
        }

        .jogo-card {
            background: rgba(15,23,42,.85);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 18px 36px rgba(0,0,0,.22);
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,130,246,.16);
            border: 1px solid rgba(96,165,250,.38);
            color: #dbeafe;
            padding: 8px 12px;
            border-radius: 999px;
            margin-bottom: 16px;
            font-size: .92rem;
        }

        .rodada {
            color: #cbd5e1;
            font-size: .96rem;
            margin-bottom: 10px;
        }

        .titulo-carta {
            font-size: 1.8rem;
            margin-bottom: 14px;
        }

        .descricao-carta {
            font-size: 1.08rem;
            color: #e2e8f0;
            line-height: 1.75;
            background: rgba(255,255,255,.03);
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 22px;
        }

        .subtitulo {
            margin-bottom: 14px;
            color: #bfdbfe;
            font-size: 1rem;
            font-weight: bold;
        }

        .acoes-resposta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .btn-resposta {
            border: 0;
            border-radius: 18px;
            padding: 18px;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: .2s ease;
            min-height: 84px;
        }

        .btn-resposta:hover {
            transform: translateY(-2px) scale(1.01);
        }

        .seguro { background: linear-gradient(135deg, #15803d, #22c55e); }
        .suspeito { background: linear-gradient(135deg, #b45309, #f59e0b); }
        .golpe { background: linear-gradient(135deg, #b91c1c, #ef4444); }

        .resultado-final {
            text-align: center;
            padding: 8px 0;
        }

        .resultado-final h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .resultado-final p {
            color: #cbd5e1;
            line-height: 1.7;
            margin-bottom: 10px;
        }

        .numero-final {
            font-size: 3rem;
            color: #93c5fd;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        .botoes-final {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .btn-final {
            text-decoration: none;
            color: #fff;
            padding: 12px 18px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border: 1px solid rgba(255,255,255,.1);
        }

        .vazio {
            text-align: center;
            color: #cbd5e1;
            padding: 10px 0;
            line-height: 1.7;
        }

        .badge-level {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(168,85,247,.12);
            border: 1px solid rgba(196,181,253,.28);
            color: #e9d5ff;
            font-size: .92rem;
        }

        @media (max-width: 980px) {
            .painel {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .acoes-resposta {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            body {
                padding: 16px;
            }

            .painel {
                grid-template-columns: 1fr;
            }

            .titulo-area h1 {
                font-size: 1.6rem;
            }

            .titulo-carta {
                font-size: 1.45rem;
            }

            .jogo-card {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="topo">
            <div class="titulo-area">
                <h1>Classifique o Golpe</h1>
                <p>Leia a situação e escolha se ela é segura, suspeita ou claramente um golpe.</p>
                <?php if ($usuarioLogado): ?>
                    <div class="badge-level">⭐ Nível <?= (int)$nivelUsuario ?> • XP total: <?= (int)$xpTotalUsuario ?></div>
                <?php endif; ?>
            </div>
            <div class="acoes-topo">
                <a class="btn-topo" href="?reiniciar=1">Reiniciar jogo</a>
            </div>
        </div>

        <div class="painel">
            <div class="card-info">
                <span>Pontuação</span>
                <strong><?= (int)$pontos ?></strong>
            </div>
            <div class="card-info">
                <span>XP da partida</span>
                <strong><?= (int)$xpPartida ?></strong>
            </div>
            <div class="card-info">
                <span>Acertos</span>
                <strong><?= (int)$acertos ?></strong>
            </div>
            <div class="card-info">
                <span>Erros</span>
                <strong><?= (int)$erros ?></strong>
            </div>
            <div class="card-info">
                <span>Progresso</span>
                <strong><?= $totalCartas > 0 ? min($indiceAtual, $totalCartas) . '/' . $totalCartas : '0/0' ?></strong>
            </div>
        </div>

        <?php if (!$usuarioLogado): ?>
            <div class="alerta info">
                <strong>XP não será salvo no banco</strong>
                Você pode jogar normalmente, mas o XP só aumenta quando o sistema consegue identificar o usuário logado na sessão e encontrar esse ID na tabela <b>usuarios</b>.
            </div>
        <?php endif; ?>


        <?php if (isset($_GET['debug_xp'])): ?>
            <div class="alerta" style="margin-bottom:16px; border-color:#f59e0b; background:rgba(245,158,11,.12);">
                <b>Debug XP</b><br>
                ID detectado na sessão: <b><?= htmlspecialchars((string)($idUsuarioLogado ?? 'nenhum')) ?></b><br>
                <?php if ($usuarioLogado): ?>
                    Usuário encontrado no banco: <b><?= htmlspecialchars((string)($usuarioLogado['nome'] ?? 'sem nome')) ?></b><br>
                    XP atual no banco: <b><?= (int)($usuarioLogado['xp_total'] ?? 0) ?></b><br>
                    Nível atual no banco: <b><?= (int)($usuarioLogado['nivel'] ?? 0) ?></b><br>
                <?php else: ?>
                    Nenhum registro encontrado na tabela <b>usuarios</b> para esse ID.<br>
                <?php endif; ?>
                <?php if (!empty($flash['debug_xp'])): ?>
                    Resultado da última tentativa de XP: <pre style="white-space:pre-wrap;margin-top:8px;"><?= htmlspecialchars(print_r($flash['debug_xp'], true)) ?></pre>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ($erroPagina): ?>
            <div class="alerta sistema">
                <strong>Erro ao carregar a página</strong>
                <?= htmlspecialchars($erroPagina) ?>
            </div>
        <?php endif; ?>

        <?php if ($flash): ?>
            <div class="alerta <?= $flash['acertou'] ? 'ok' : 'erro' ?>">
                <strong><?= $flash['acertou'] ? 'Você acertou!' : 'Você errou.' ?></strong>
                Carta: <b><?= htmlspecialchars($flash['titulo']) ?></b><br>
                Sua resposta: <b><?= htmlspecialchars(ucfirst($flash['resposta_usuario'])) ?></b><br>
                Resposta correta: <b><?= htmlspecialchars(ucfirst($flash['resposta_correta'])) ?></b><br>
                Explicação: <?= htmlspecialchars($flash['explicacao']) ?><br>
                <?php if (!empty($flash['xp_ganho'])): ?>
                    XP ganho: <b>+<?= (int)$flash['xp_ganho'] ?> XP</b><br>
                <?php endif; ?>
                <?php if (!empty($flash['xp_total'])): ?>
                    XP total: <b><?= (int)$flash['xp_total'] ?></b><br>
                <?php endif; ?>
                <?php if (!empty($flash['subiu_nivel'])): ?>
                    <b>Parabéns! Você subiu para o nível <?= (int)$flash['nivel_depois'] ?>.</b>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="jogo-card">
            <?php if ($totalCartas === 0): ?>
                <div class="vazio">
                    <h2 style="margin-bottom: 10px;">Nenhuma carta cadastrada</h2>
                    <p>Cadastre registros na tabela <b>cartas_classificacao</b> para o jogo aparecer.</p>
                </div>

            <?php elseif ($jogoFinalizado): ?>
                <?php
                    $percentual = $totalCartas > 0 ? round(($acertos / $totalCartas) * 100) : 0;
                    $mensagemFinal = textoFaixaResultado((float)$percentual);
                ?>
                <div class="resultado-final">
                    <h2>Fim de jogo</h2>
                    <div class="numero-final"><?= (int)$percentual ?>%</div>
                    <p><b><?= (int)$acertos ?></b> acertos de <b><?= (int)$totalCartas ?></b> cartas.</p>
                    <p><?= htmlspecialchars($mensagemFinal) ?></p>
                    <p>Pontuação final: <b><?= (int)$pontos ?> pontos</b></p>
                    <p>XP ganho na partida: <b><?= (int)$xpPartida ?> XP</b></p>
                    <?php if ($usuarioLogado): ?>
                        <p>Seu XP total agora é <b><?= (int)$xpTotalUsuario ?> XP</b> no nível <b><?= (int)$nivelUsuario ?></b>.</p>
                    <?php endif; ?>

                    <div class="botoes-final">
                        <a class="btn-final" href="?reiniciar=1">Jogar novamente</a>
                    </div>
                </div>

            <?php elseif ($carta): ?>
                <div class="tag"><?= htmlspecialchars(iconeTipo((string)$carta['tipo'])) ?></div>
                <div class="rodada">Rodada <?= (int)($indiceAtual + 1) ?> de <?= (int)$totalCartas ?></div>
                <h2 class="titulo-carta"><?= htmlspecialchars($carta['titulo']) ?></h2>
                <div class="descricao-carta">
                    <?= nl2br(htmlspecialchars($carta['descricao'])) ?>
                </div>

                <div class="subtitulo">Escolha a classificação correta:</div>

                <form method="POST">
                    <div class="acoes-resposta">
                        <button type="submit" name="resposta" value="seguro" class="btn-resposta seguro">🛡️ Seguro</button>
                        <button type="submit" name="resposta" value="suspeito" class="btn-resposta suspeito">⚠️ Suspeito</button>
                        <button type="submit" name="resposta" value="golpe" class="btn-resposta golpe">🚨 Golpe</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
