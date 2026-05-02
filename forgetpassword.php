<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Recuperar Senha | CyberEdu®</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="Icon.png">
<style>
body {
    margin: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

    font-family: 'Poppins', sans-serif;
      background: 
    linear-gradient(135deg, rgba(2, 6, 23, 0.45), rgba(15, 23, 42, 0.9)),
    url("bgrec.png");
}

form {
    background: rgba(15, 23, 42, 0.9);
    padding: 30px;
    border-radius: 12px;
    width: 300px;

    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    backdrop-filter: blur(10px);
}

h2 {
    color: #1580fa;
    text-align: center;
    margin-bottom: 20px;
}

label {
    color: #cbd5f5;
    font-size: 14px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;

    border-radius: 8px;
    border: none;
    outline: none;

    background: #1e293b;
    color: white;
}

input:focus {
    box-shadow: 0 0 5px #274fe1;
}

button {
    width: 100%;
    padding: 12px;

    border: none;
    border-radius: 8px;
    cursor: pointer;

    background: #154afa;
    color: #0f172a;
    font-weight: bold;
    transition: 0.3s;
    
}

button:hover {
    background: #fde047;
    box-shadow: 0 0 10px #facc15;
}

.image-box {
  display: flex;
  justify-content: center;
  margin-bottom: 15px;
}

/* imagem da raposa */
.image-box img {
  width: 350px; /* menor */
  height: auto;
  position: relative;
  z-index: 1;

  animation: float 3s ease-in-out infinite;
}

.image-box img {
  width: 450px;
  height: auto;

  animation: float 3s ease-in-out infinite;

  /* ✨ GLOW CONTORNANDO A IMAGEM */
  filter: 
    drop-shadow(0 0 8px rgba(255, 230, 0, 0.9))
    drop-shadow(0 0 16px rgba(255, 200, 0, 0.7))
    drop-shadow(0 0 24px rgba(255, 150, 0, 0.5));
}
/* flutuação */
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

/* pulsar glow */
@keyframes pulse {
  0%, 100% {
    opacity: 0.7;
    transform: scale(1);
  }
  50% {
    opacity: 1;
    transform: scale(1.2);
  }
}

</style>
</head>

<body>

  <div class="image-box">
    <img src="5.png" alt="Raposa segurança">
  </div>

  <form method="POST" action="send-password-reset.php">
    <h2>Esqueci minha senha</h2>

    <label>Email</label>
    <input type="email" name="email" placeholder="Digite seu email" required>

    <button type="submit">Enviar link</button>
  </form>

</body>