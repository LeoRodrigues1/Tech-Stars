<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Tech Stars - Login</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
  <div class="container">

    <div class="form-section login-form">
      <div class="form-container">
        <h1>Tech Stars</h1>
        <h2>Login</h2>

        <?php if (isset($_GET['error'])): ?>
          <p class="error" style="color:red;">
            <?php 
              if ($_GET['error'] === 'login_invalido') {
                echo "Usuário ou senha inválidos.";
              } else if ($_GET['error'] === 'email_invalido') {
                echo "Email inválido.";
              } else {
                echo "Erro desconhecido.";
              }
            ?>
          </p>
        <?php endif; ?>

        <form action="login_process.php" method="post">
          <input type="email" name="email" placeholder="Digite seu e-mail" required />
          <input type="password" name="senha" placeholder="Digite sua senha" required />
          <button type="submit">Entrar</button>
        </form>

        <div class="extra-links">
          <a href="cadastro.php">Cadastrar</a> / 
        </div>
      </div>
    </div>

    <div class="video-section">
      <div class="video-overlay"></div>
      <video autoplay muted loop class="background-video">
        <source src="assets/video/background.mp4" type="video/mp4" />
      </video>
    </div>

  </div>
</body>
</html>
