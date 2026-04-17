-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: quiz_golpes_digitais
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alternativas`
--

DROP TABLE IF EXISTS `alternativas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alternativas` (
  `id_alternativa` int NOT NULL AUTO_INCREMENT,
  `id_pergunta` int DEFAULT NULL,
  `texto_alternativa` text COLLATE utf8mb4_general_ci,
  `correta` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_alternativa`),
  KEY `id_pergunta` (`id_pergunta`),
  CONSTRAINT `alternativas_ibfk_1` FOREIGN KEY (`id_pergunta`) REFERENCES `perguntas` (`id_pergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=1669 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternativas`
--

LOCK TABLES `alternativas` WRITE;
/*!40000 ALTER TABLE `alternativas` DISABLE KEYS */;
INSERT INTO `alternativas` VALUES (1609,1,'Tentativa de roubar dados fingindo ser empresa confiável',1),(1610,1,'Sistema automático de proteção de e-mails',0),(1611,1,'Tipo de backup de segurança online',0),(1612,1,'Ferramenta usada para acelerar a internet',0),(1613,2,'Erros de escrita e endereço estranho do remetente',1),(1614,2,'Layout moderno e bem organizado',0),(1615,2,'Envio automático do banco oficial',0),(1616,2,'Mensagem com assinatura digital válida',0),(1617,3,'Nunca informar e entrar em contato com o banco',1),(1618,3,'Responder rapidamente para evitar bloqueio',0),(1619,3,'Clicar no link e atualizar os dados',0),(1620,3,'Ignorar e continuar usando normalmente',0),(1621,4,'Fraude onde o golpista engana a vítima para transferir dinheiro',1),(1622,4,'Erro no sistema bancário durante transferência',0),(1623,4,'Taxa obrigatória cobrada pelo banco',0),(1624,4,'Atualização de segurança do aplicativo',0),(1625,5,'Boleto adulterado que direciona pagamento ao golpista',1),(1626,5,'Documento oficial emitido pelo banco',0),(1627,5,'Comprovante automático de pagamento',0),(1628,5,'Cobrança legítima de serviço contratado',0),(1629,6,'Conferindo o endereço e se possui HTTPS com cadeado',1),(1630,6,'Observando se o site é colorido e bonito',0),(1631,6,'Verificando se possui muitas imagens',0),(1632,6,'Acessando apenas pelo celular',0),(1633,7,'Roubo de dados pessoais ou instalação de vírus',1),(1634,7,'Melhoria no desempenho do dispositivo',0),(1635,7,'Atualização automática do sistema',0),(1636,7,'Aumento da velocidade da internet',0),(1637,8,'Técnica de manipulação psicológica para enganar pessoas',1),(1638,8,'Sistema de segurança digital avançado',0),(1639,8,'Ferramenta de criptografia de dados',0),(1640,8,'Programa para melhorar redes sociais',0),(1641,9,'Para dificultar o acesso de invasores às contas',1),(1642,9,'Para aumentar a velocidade da internet',0),(1643,9,'Para melhorar o desempenho do celular',0),(1644,9,'Para evitar atualizações do sistema',0),(1645,10,'Camada extra de segurança além da senha',1),(1646,10,'Substituição completa da senha',0),(1647,10,'Sistema que desativa contas automaticamente',0),(1648,10,'Ferramenta para limpar dados do dispositivo',0),(1649,11,'Pode permitir interceptação de dados por terceiros',1),(1650,11,'Sempre aumenta a segurança da conexão',0),(1651,11,'Bloqueia automaticamente ataques virtuais',0),(1652,11,'Impede acesso a sites perigosos',0),(1653,12,'Possível golpe ou fraude online',1),(1654,12,'Desconto oficial do governo',0),(1655,12,'Campanha obrigatória das empresas',0),(1656,12,'Erro de sistema sempre corrigido depois',0),(1657,13,'Conter vírus ou programas maliciosos',1),(1658,13,'Ser mais seguros que os oficiais',0),(1659,13,'Melhorar o desempenho do celular',0),(1660,13,'Aumentar a duração da bateria',0),(1661,14,'Denunciar e evitar compartilhar a informação falsa',1),(1662,14,'Ignorar completamente e não fazer nada',0),(1663,14,'Compartilhar para avisar amigos sem verificar',0),(1664,14,'Responder ao golpista para entender melhor',0),(1665,15,'Quando alguém acessa sua conta usando código de verificação',1),(1666,15,'Atualização automática do aplicativo',0),(1667,15,'Erro no servidor do WhatsApp',0),(1668,15,'Falha temporária de conexão com a internet',0);
/*!40000 ALTER TABLE `alternativas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Phishing','Golpes por email ou mensagens falsas'),(2,'Golpes Bancarios','Fraudes envolvendo bancos'),(3,'Redes Sociais','Golpes em redes sociais'),(4,'Compras Online Falsas',NULL),(5,'Segurança Digital',NULL);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cenarios_golpe`
--

DROP TABLE IF EXISTS `cenarios_golpe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cenarios_golpe` (
  `id_cenario` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_cenario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cenarios_golpe`
--

LOCK TABLES `cenarios_golpe` WRITE;
/*!40000 ALTER TABLE `cenarios_golpe` DISABLE KEYS */;
INSERT INTO `cenarios_golpe` VALUES (1,'Site falso de banco','banco_falso.png','Identifique sinais de golpe.'),(2,'Loja online suspeita','loja_falsa.png','Identifique sinais de fraude.'),(3,'Email phishing','email_phishing.png','Identifique sinais de phishing.'),(4,'SMS falso Correios','golpe4.png',NULL),(9,'Loja falsa ecommerce','golpe3.png',NULL);
/*!40000 ALTER TABLE `cenarios_golpe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conquistas`
--

DROP TABLE IF EXISTS `conquistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conquistas` (
  `id_conquista` int NOT NULL AUTO_INCREMENT,
  `nome_conquista` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `xp_bonus` int DEFAULT NULL,
  PRIMARY KEY (`id_conquista`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conquistas`
--

LOCK TABLES `conquistas` WRITE;
/*!40000 ALTER TABLE `conquistas` DISABLE KEYS */;
INSERT INTO `conquistas` VALUES (1,'Primeira Resposta','Responder primeira pergunta',10),(2,'Acertou 10 perguntas','Especialista iniciante',50);
/*!40000 ALTER TABLE `conquistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `erros_cenario`
--

DROP TABLE IF EXISTS `erros_cenario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `erros_cenario` (
  `id_erro` int NOT NULL AUTO_INCREMENT,
  `id_cenario` int DEFAULT NULL,
  `x_min` int DEFAULT NULL,
  `x_max` int DEFAULT NULL,
  `y_min` int DEFAULT NULL,
  `y_max` int DEFAULT NULL,
  `explicacao` text,
  PRIMARY KEY (`id_erro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erros_cenario`
--

LOCK TABLES `erros_cenario` WRITE;
/*!40000 ALTER TABLE `erros_cenario` DISABLE KEYS */;
INSERT INTO `erros_cenario` VALUES (1,3,-148,148,314,338,'Página falsa de banco pedindo dados de acesso para roubo de credenciais.'),(2,1,-277,-187,215,237,'Site marcado como NÃO SEGURO pelo navegador.'),(3,6,-18,192,-224,-198,'Email phishing: domínio falso e link suspeito pedindo regularização urgente.'),(4,4,-186,129,48,213,'Mensagem SMS com link falso solicitando pagamento de taxa.'),(5,9,20,260,-40,200,'Preço extremamente baixo e link encurtado indicam possível golpe.');
/*!40000 ALTER TABLE `erros_cenario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `estatisticas_usuario`
--

DROP TABLE IF EXISTS `estatisticas_usuario`;
/*!50001 DROP VIEW IF EXISTS `estatisticas_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `estatisticas_usuario` AS SELECT 
 1 AS `nome`,
 1 AS `total_respostas`,
 1 AS `total_acertos`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `fases`
--

DROP TABLE IF EXISTS `fases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fases` (
  `id_fase` int NOT NULL AUTO_INCREMENT,
  `nome_fase` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `nivel_minimo` int DEFAULT NULL,
  `xp_recompensa` int DEFAULT NULL,
  PRIMARY KEY (`id_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fases`
--

LOCK TABLES `fases` WRITE;
/*!40000 ALTER TABLE `fases` DISABLE KEYS */;
INSERT INTO `fases` VALUES (1,'Fase 1','Golpes básicos',1,50),(2,'Fase 2','Phishing e links falsos',2,80),(3,'Fase 3','Golpes avançados',3,120);
/*!40000 ALTER TABLE `fases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memoria_cartas`
--

DROP TABLE IF EXISTS `memoria_cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memoria_cartas` (
  `id_carta` int NOT NULL AUTO_INCREMENT,
  `id_tema` int DEFAULT NULL,
  `conteudo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_par` int DEFAULT NULL,
  PRIMARY KEY (`id_carta`),
  KEY `id_tema` (`id_tema`),
  CONSTRAINT `memoria_cartas_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `memoria_temas` (`id_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memoria_cartas`
--

LOCK TABLES `memoria_cartas` WRITE;
/*!40000 ALTER TABLE `memoria_cartas` DISABLE KEYS */;
INSERT INTO `memoria_cartas` VALUES (1,1,'Phishing',1),(2,1,'Email falso',1),(3,1,'Golpe do PIX',2),(4,1,'Transferência urgente',2),(5,1,'Boleto falso',3),(6,1,'Código de barras adulterado',3),(7,1,'Perfil falso',4),(8,1,'Golpe em redes sociais',4),(9,1,'WhatsApp clonado',5),(10,1,'Código SMS roubado',5),(11,1,'Senha fraca',6),(12,1,'Conta invadida',6),(13,1,'Promoção falsa',7),(14,1,'Site fraudulento',7),(15,1,'Engenharia social',8),(16,1,'Manipulação psicológica',8),(17,1,'Wi‑Fi público',9),(18,1,'Roubo de dados',9),(19,1,'Link suspeito',10),(20,1,'Site malicioso',10),(21,1,'Aplicativo falso',11),(22,1,'Malware',11),(23,1,'Loja falsa',12),(24,1,'Compra fraudulenta',12),(25,1,'Código de verificação',13),(26,1,'Roubo de conta',13),(27,1,'Mensagem urgente',14),(28,1,'Golpe emocional',14),(29,1,'Antivírus',15),(30,1,'Proteção contra malware',15),(31,1,'Senha forte',16),(32,1,'Segurança da conta',16),(33,1,'Autenticação 2 fatores',17),(34,1,'Proteção extra',17),(35,1,'Denunciar golpe',18),(36,1,'Proteção coletiva',18),(37,1,'Educação digital',19),(38,1,'Prevenção de fraudes',19),(39,1,'Verificar fonte',20),(40,1,'Informação confiável',20);
/*!40000 ALTER TABLE `memoria_cartas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memoria_sessoes`
--

DROP TABLE IF EXISTS `memoria_sessoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memoria_sessoes` (
  `id_sessao` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `pontuacao` int DEFAULT NULL,
  PRIMARY KEY (`id_sessao`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `memoria_sessoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memoria_sessoes`
--

LOCK TABLES `memoria_sessoes` WRITE;
/*!40000 ALTER TABLE `memoria_sessoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `memoria_sessoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memoria_temas`
--

DROP TABLE IF EXISTS `memoria_temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memoria_temas` (
  `id_tema` int NOT NULL AUTO_INCREMENT,
  `nome_tema` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memoria_temas`
--

LOCK TABLES `memoria_temas` WRITE;
/*!40000 ALTER TABLE `memoria_temas` DISABLE KEYS */;
INSERT INTO `memoria_temas` VALUES (1,'Golpes Digitais','Cartas educativas sobre golpes e segurança digital');
/*!40000 ALTER TABLE `memoria_temas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memoria_tentativas`
--

DROP TABLE IF EXISTS `memoria_tentativas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memoria_tentativas` (
  `id_tentativa` int NOT NULL AUTO_INCREMENT,
  `id_sessao` int DEFAULT NULL,
  `carta1` int DEFAULT NULL,
  `carta2` int DEFAULT NULL,
  `acertou` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_tentativa`),
  KEY `id_sessao` (`id_sessao`),
  CONSTRAINT `memoria_tentativas_ibfk_1` FOREIGN KEY (`id_sessao`) REFERENCES `memoria_sessoes` (`id_sessao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memoria_tentativas`
--

LOCK TABLES `memoria_tentativas` WRITE;
/*!40000 ALTER TABLE `memoria_tentativas` DISABLE KEYS */;
/*!40000 ALTER TABLE `memoria_tentativas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perguntas`
--

DROP TABLE IF EXISTS `perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perguntas` (
  `id_pergunta` int NOT NULL AUTO_INCREMENT,
  `texto_pergunta` text COLLATE utf8mb4_general_ci,
  `id_categoria` int DEFAULT NULL,
  `id_fase` int DEFAULT NULL,
  `nivel_dificuldade` int DEFAULT NULL,
  `xp` int DEFAULT '10',
  PRIMARY KEY (`id_pergunta`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fase` (`id_fase`),
  CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  CONSTRAINT `perguntas_ibfk_2` FOREIGN KEY (`id_fase`) REFERENCES `fases` (`id_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perguntas`
--

LOCK TABLES `perguntas` WRITE;
/*!40000 ALTER TABLE `perguntas` DISABLE KEYS */;
INSERT INTO `perguntas` VALUES (1,'O que é phishing?',1,1,1,10),(2,'Qual é um sinal comum de email falso?',1,1,1,10),(3,'O que fazer ao receber mensagem pedindo senha do banco?',1,1,1,10),(4,'O que é golpe do PIX?',1,1,1,10),(5,'O que é um boleto falso?',1,1,1,10),(6,'Como verificar se um site é seguro?',1,1,1,10),(7,'O que pode acontecer ao clicar em link malicioso?',1,1,1,10),(8,'O que é engenharia social?',1,1,1,10),(9,'Por que usar senhas fortes?',1,1,1,10),(10,'O que é autenticação em dois fatores?',1,1,1,10),(11,'Wi-Fi público pode ser perigoso por quê?',1,1,1,10),(12,'Promoções com preços muito baixos podem indicar o quê?',1,1,1,10),(13,'Aplicativos fora da loja oficial podem:',1,1,1,10),(14,'O que fazer ao identificar um golpe online?',1,1,1,10),(15,'O que é golpe de clonagem de WhatsApp?',1,1,1,10);
/*!40000 ALTER TABLE `perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progresso_fase`
--

DROP TABLE IF EXISTS `progresso_fase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progresso_fase` (
  `id_progresso` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_fase` int DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_conclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_progresso`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_fase` (`id_fase`),
  CONSTRAINT `progresso_fase_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `progresso_fase_ibfk_2` FOREIGN KEY (`id_fase`) REFERENCES `fases` (`id_fase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progresso_fase`
--

LOCK TABLES `progresso_fase` WRITE;
/*!40000 ALTER TABLE `progresso_fase` DISABLE KEYS */;
/*!40000 ALTER TABLE `progresso_fase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `ranking_usuarios`
--

DROP TABLE IF EXISTS `ranking_usuarios`;
/*!50001 DROP VIEW IF EXISTS `ranking_usuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `ranking_usuarios` AS SELECT 
 1 AS `nome`,
 1 AS `xp_total`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `respostas_usuario`
--

DROP TABLE IF EXISTS `respostas_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respostas_usuario` (
  `id_resposta` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_pergunta` int DEFAULT NULL,
  `id_alternativa` int DEFAULT NULL,
  `acertou` tinyint(1) DEFAULT NULL,
  `tempo_resposta` int DEFAULT NULL,
  `data_resposta` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resposta`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_pergunta` (`id_pergunta`),
  KEY `id_alternativa` (`id_alternativa`),
  CONSTRAINT `respostas_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `respostas_usuario_ibfk_2` FOREIGN KEY (`id_pergunta`) REFERENCES `perguntas` (`id_pergunta`),
  CONSTRAINT `respostas_usuario_ibfk_3` FOREIGN KEY (`id_alternativa`) REFERENCES `alternativas` (`id_alternativa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostas_usuario`
--

LOCK TABLES `respostas_usuario` WRITE;
/*!40000 ALTER TABLE `respostas_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `respostas_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_conquistas`
--

DROP TABLE IF EXISTS `usuario_conquistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_conquistas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_conquista` int DEFAULT NULL,
  `data_conquista` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_conquista` (`id_conquista`),
  CONSTRAINT `usuario_conquistas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `usuario_conquistas_ibfk_2` FOREIGN KEY (`id_conquista`) REFERENCES `conquistas` (`id_conquista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_conquistas`
--

LOCK TABLES `usuario_conquistas` WRITE;
/*!40000 ALTER TABLE `usuario_conquistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_conquistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `xp_total` int DEFAULT '0',
  `nivel` int DEFAULT '1',
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Jogador Teste','teste@email.com','123456',0,1,'2026-03-14 19:46:56'),(2,'samuel','samuelgomes@gmail.com','$2y$10$oJKvqPBurKcyMunypSIPC.iZ.GWnJ8LsbaaLonCVbupmJbJdWLQbq',1960,1,'2026-04-06 03:46:24'),(4,'Samuel Vinícius','manuelgomes@gmail.com','$2y$10$bm5Dq3hBg72b96t0YDOTjeVOxXDCiLswjA/pLAr3sd3SDvyWvpmUe',0,1,'2026-04-06 21:47:13');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verdadeiro_falso`
--

DROP TABLE IF EXISTS `verdadeiro_falso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verdadeiro_falso` (
  `id_pergunta` int NOT NULL AUTO_INCREMENT,
  `pergunta` text COLLATE utf8mb4_general_ci,
  `resposta_correta` tinyint(1) DEFAULT NULL,
  `explicacao` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_pergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verdadeiro_falso`
--

LOCK TABLES `verdadeiro_falso` WRITE;
/*!40000 ALTER TABLE `verdadeiro_falso` DISABLE KEYS */;
INSERT INTO `verdadeiro_falso` VALUES (1,'Golpistas podem enviar e-mails que imitam bancos ou empresas conhecidas para enganar usuários e roubar dados pessoais.',1,'Esse tipo de golpe é chamado de phishing. O criminoso finge ser uma empresa confiável para que a vítima informe dados sensíveis.'),(2,'Se um site possui cadeado HTTPS na barra do navegador, isso garante que ele é sempre legítimo e não pode ser um golpe.',0,'O HTTPS indica apenas que a conexão é criptografada, mas o site ainda pode ser falso se estiver imitando uma empresa.'),(3,'Nunca se deve compartilhar códigos de verificação recebidos por SMS, pois eles podem permitir que alguém acesse sua conta.',1,'Esses códigos são usados para autenticação e devem ser mantidos em segredo.'),(4,'Golpistas frequentemente criam senso de urgência em mensagens para fazer a vítima agir rapidamente sem verificar a informação.',1,'A pressão psicológica é uma técnica comum usada em engenharia social.'),(5,'Aplicativos baixados fora das lojas oficiais são sempre seguros se tiverem muitas avaliações positivas.',0,'Aplicativos fora de lojas oficiais podem conter malware ou programas maliciosos.'),(6,'Perfis falsos em redes sociais podem ser usados para aplicar golpes financeiros ou coletar informações pessoais.',1,'Criminosos criam perfis falsos para ganhar confiança e manipular vítimas.'),(7,'Usar a mesma senha em vários sites é uma prática segura porque facilita lembrar as senhas.',0,'Se um site for invadido, todas as contas com a mesma senha podem ser comprometidas.'),(8,'Atualizar aplicativos e sistemas operacionais ajuda a corrigir falhas de segurança.',1,'Atualizações frequentemente corrigem vulnerabilidades exploradas por hackers.'),(9,'Golpes de falso suporte técnico acontecem quando criminosos fingem ser técnicos de empresas para pedir acesso ao computador.',1,'Nesse golpe, o criminoso tenta convencer a vítima a instalar softwares ou revelar informações.'),(10,'Redes Wi-Fi públicas são sempre seguras para acessar aplicativos bancários.',0,'Em redes públicas, criminosos podem interceptar dados se a conexão não for segura.'),(11,'Golpistas podem clonar contas de WhatsApp usando códigos de verificação enviados para o celular da vítima.',1,'Se a vítima informar o código, o criminoso pode assumir a conta.'),(12,'Um e-mail com muitos erros de ortografia e links estranhos pode indicar tentativa de golpe.',1,'Mensagens fraudulentas frequentemente apresentam erros e links suspeitos.'),(13,'Sites de compras com preços extremamente baixos sempre indicam promoções legítimas.',0,'Preços muito abaixo do mercado podem indicar lojas falsas ou golpes.'),(14,'Engenharia social é uma técnica usada por criminosos para manipular pessoas e obter informações confidenciais.',1,'Nesse tipo de ataque o criminoso explora emoções e confiança da vítima.'),(15,'Antivírus e softwares de segurança ajudam a reduzir o risco de infecção por malware.',1,'Eles detectam e bloqueiam programas maliciosos.'),(16,'Se um amigo pedir dinheiro por mensagem, não é necessário confirmar porque a conta sempre pertence à pessoa.',0,'Golpistas podem invadir contas ou cloná-las para pedir dinheiro.'),(17,'Links enviados por desconhecidos em redes sociais podem direcionar para sites maliciosos.',1,'Esses sites podem roubar dados ou instalar vírus.'),(18,'Um certificado digital HTTPS impede completamente qualquer tipo de fraude online.',0,'Mesmo com HTTPS, o site pode ser fraudulento se estiver imitando outro.'),(19,'Golpes de investimento prometendo lucros garantidos e muito rápidos são frequentemente usados por criminosos.',1,'Promessas de ganhos altos e rápidos são um sinal clássico de fraude.'),(20,'Verificar a fonte de uma informação antes de compartilhá-la ajuda a evitar a disseminação de golpes digitais.',1,'Checar a veracidade da informação reduz a propagação de fraudes.');
/*!40000 ALTER TABLE `verdadeiro_falso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `estatisticas_usuario`
--

/*!50001 DROP VIEW IF EXISTS `estatisticas_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `estatisticas_usuario` AS select `u`.`nome` AS `nome`,count(`r`.`id_resposta`) AS `total_respostas`,sum(`r`.`acertou`) AS `total_acertos` from (`usuarios` `u` left join `respostas_usuario` `r` on((`u`.`id_usuario` = `r`.`id_usuario`))) group by `u`.`nome` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ranking_usuarios`
--

/*!50001 DROP VIEW IF EXISTS `ranking_usuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ranking_usuarios` AS select `usuarios`.`nome` AS `nome`,`usuarios`.`xp_total` AS `xp_total` from `usuarios` order by `usuarios`.`xp_total` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-06 23:47:58
