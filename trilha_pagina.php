<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['slug'])) {
    header('Location: dashboard.php?error=trilha_invalida');
    exit;
}

$slug = $_GET['slug'];

try {
    $stmt_trilha = $pdo->prepare("SELECT id, nome FROM trilhas WHERE slug = ?");
    $stmt_trilha->execute([$slug]);
    $trilha = $stmt_trilha->fetch();

    if (!$trilha) {
        header('Location: dashboard.php?error=trilha_nao_encontrada');
        exit;
    }

} catch (PDOException $e) {
    die("Erro ao carregar a página da trilha: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Trilha de <?php echo htmlspecialchars($trilha['nome']); ?></title>
    <link rel="stylesheet" href="assets/css/style_dashboard.css"> </head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">🌟 Tech Stars</div>
            <a class="cta-button" href="dashboard.php">Voltar para o Dashboard</a>
        </div>
    </nav>

    <section class="form-section">
        <div class="form-container">
            <h1>Trilha de Aprendizado: <?php echo htmlspecialchars($trilha['nome']); ?></h1>
            <p>Explore os conteúdos disponíveis abaixo e comece sua jornada!</p>
        </div>
    </section>

    <section class="cards-grid">
        <h2>Conteúdos Disponíveis</h2>

        <div class="tech-card" style="width: 100%; text-align: center;">
            <p>Em breve, os vídeos e materiais desta trilha estarão disponíveis aqui.</p>
            <p>Estamos trabalhando para trazer o melhor conteúdo para você!</p>
        </div>

    </section>
</body>
</html>