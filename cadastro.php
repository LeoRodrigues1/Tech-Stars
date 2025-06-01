<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Tech Stars - Cadastro</title>
  <link rel="stylesheet" href="assets/css/style.css">
<body>
  <div class="container">

    <div class="form-section cadastro-form">
      <div class="form-container">
        <h1>Tech Stars</h1>
        <h2>Cadastro</h2>
        <form action="cadastro_process.php" method="post">
          <input type="text" name="nome" placeholder="Digite seu nome completo" required>
          <input type="email" name="email" placeholder="Digite seu e-mail" required>
          <input type="email" name="confirmacao-email" placeholder="Confirme seu e-mail" required>
          <input type="password" name="senha" placeholder="Crie uma senha" required>
          <input type="password" name="confirmacao-senha" placeholder="Confirme sua senha" required>
          <input type="date" name="data-nascimento" placeholder="Data de nascimento" required>
          <label for="genero"></label>
          <select name="genero" id="genero" required>
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
