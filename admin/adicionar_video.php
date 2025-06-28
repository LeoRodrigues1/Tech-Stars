<?php
// admin/adicionar_video.php
session_start();
require '../conexao.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$trilhas = $pdo->query("SELECT id, nome FROM trilhas ORDER BY nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Vídeo</title>
    <link rel="stylesheet" href="../assets/css/style_dashboard.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">🌟 Tech Stars [Admin]</div>
            <a class="cta-button" href="admin_dashboard.php">Voltar para o Painel</a>
        </div>
    </nav>
    <section class="form-section">
        <div class="form-container">
            <h1>Adicionar Novo Vídeo</h1>
            <?php if (isset($_GET['success'])): ?>
                <p style="color: green;">Vídeo adicionado com sucesso!</p>
            <?php elseif (isset($_GET['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <form action="processa_video.php" method="post">
                <label for="titulo">Título do Vídeo:</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4"></textarea>

                <label for="trilha_id">Trilha de Aprendizado:</label>
                <select id="trilha_id" name="trilha_id" required>
                    <option value="">-- Selecione uma Trilha --</option>
                    <?php foreach ($trilhas as $trilha): ?>
                        <option value="<?php echo $trilha['id']; ?>"><?php echo htmlspecialchars($trilha['nome']); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="video_url">URL do Vídeo no YouTube:</label>
                <input type="text" id="video_url" name="video_url" placeholder="https://www.youtube.com/watch?v=..." required>

                <button type="submit">Adicionar Vídeo</button>
            </form>
        </div>
    </section>
</body>
</html>