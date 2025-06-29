<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: ../dashboard.php?error=acesso_negado');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="../assets/css/style_dashboard.css"> </head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">🌟 Tech Stars [Admin]</div>
            <a class="cta-button" href="../dashboard.php">Voltar para o site</a>
        </div>
    </nav>

    <section class="form-section">
        <div class="form-container">
            <h1>Painel de Gerenciamento</h1>
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</p>
            <p>Aqui você poderá gerenciar os conteúdos do site.</p>

            <div style="margin-top: 20px;">
                <a href="adicionar_video.php"><button>Adicionar Vídeo (URL)</button></a>
                <a href="gerenciar_videos.php"><button>Gerenciar/Excluir Vídeos</button></a>
            </div>
        </div>
    </section>
</body>
</html>