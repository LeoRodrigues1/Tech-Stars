<?php
session_start();

// Se o usuário já estiver logado, redireciona para o dashboard
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Mapeamento de mensagens de erro/sucesso para o cadastro
$cadastro_messages = [
    'email_nao_confere' => 'Os e-mails digitados não conferem ou são inválidos.',
    'senha_nao_confere' => 'As senhas digitadas não conferem ou estão vazias.',
    'email_ja_existe'   => 'Este e-mail já está cadastrado. Tente fazer login ou use outro e-mail.',
    'erro_servidor'     => 'Ocorreu um erro no servidor ao tentar cadastrar. Tente novamente mais tarde.',
    'cadastro_ok'       => 'Cadastro realizado com sucesso! Faça login para continuar.',
];

$display_message = '';
if (isset($_GET['error']) && array_key_exists($_GET['error'], $cadastro_messages)) {
    $display_message = '<p class="error" style="color:red; text-align:center; margin-bottom: 10px;">' . htmlspecialchars($cadastro_messages[$_GET['error']]) . '</p>';
} elseif (isset($_GET['success']) && array_key_exists($_GET['success'], $cadastro_messages)) {
    $display_message = '<p class="success" style="color:green; text-align:center; margin-bottom: 10px;">' . htmlspecialchars($cadastro_messages[$_GET['success']]) . '</p>';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Tech Stars - Cadastro</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head> 
<body>
  <div class="container">
    <div class="form-section cadastro-form">
      <div class="form-container">
        <h1>Tech Stars</h1>
        <h2>Cadastro</h2>

        <?php echo $display_message; // Exibe a mensagem de erro ou sucesso ?>
        <form action="cadastro_process.php" method="post">
          <input type="text" name="nome" placeholder="Digite seu nome completo" required>
          <input type="email" name="email" placeholder="Digite seu e-mail" required>
          <input type="email" name="confirmacao-email" placeholder="Confirme seu e-mail" required>
          <input type="password" name="senha" placeholder="Crie uma senha" required>
          <input type="password" name="confirmacao-senha" placeholder="Confirme sua senha" required>
          <input type="date" name="data-nascimento" required> 
          <label for="genero" class="sr-only">Selecione seu gênero</label> <select name="genero" id="genero" required>
              <option value="" disabled selected>Selecione seu gênero</option>
              <option value="masculino">Masculino</option>
              <option value="feminino">Feminino</option>
              <option value="outro">Outro</option>
            </select>
          <button type="submit">Cadastrar</button>
        </form>
        
        <div class="extra-links">
          <a href="index.php">Já tem conta? Login</a>
        </div>
      </div>
    </div>

    <div class="video-section">
      <div class="video-overlay"></div>
        <video autoplay muted loop class="background-video">
        <source src="assets/video/background.mp4" type="video/mp4">
        </video>
      </div>
    </div>
</body>
</html>