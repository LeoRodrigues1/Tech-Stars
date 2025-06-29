<?php
session_start();
require 'conexao.php';

// --- VERIFICAÇÕES INICIAIS ---
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
if (!isset($_GET['slug'])) {
    header('Location: dashboard.php?error=trilha_invalida');
    exit;
}
$slug = $_GET['slug'];

// --- BUSCAR DADOS DA TRILHA E DOS VÍDEOS ---
try {
    // Busca os detalhes da trilha específica usando o slug
    $stmt_trilha = $pdo->prepare("SELECT id, nome, descricao FROM trilhas WHERE slug = ?");
    $stmt_trilha->execute([$slug]);
    $trilha = $stmt_trilha->fetch();

    if (!$trilha) {
        header('Location: dashboard.php?error=trilha_nao_encontrada');
        exit;
    }

    // Busca os vídeos que pertencem a esta trilha
    $stmt_videos = $pdo->prepare("SELECT titulo, descricao, caminho_arquivo FROM videos WHERE trilha_id = ? ORDER BY id");
    $stmt_videos->execute([$trilha['id']]);
    $videos = $stmt_videos->fetchAll();

} catch (PDOException $e) {
    die("Erro ao carregar a página da trilha: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Trilha de <?php echo htmlspecialchars($trilha['nome']); ?></title>
    <link rel="stylesheet" href="assets/css/style_dashboard.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">🌟 Tech Stars</div>
            <a class="cta-button" href="dashboard.php">Voltar para o Dashboard</a>
        </div>
    </nav>

    <section class="form-section" style="padding: 40px 20px;">
        <div class="form-container">
            <h1>Trilha de Aprendizado: <?php echo htmlspecialchars($trilha['nome']); ?></h1>
            <p style="max-width: 800px; margin: 10px auto 0 auto;"><?php echo htmlspecialchars($trilha['descricao']); ?></p>
        </div>
    </section>

    <section class="cards-grid" style="padding-top: 20px;">
        <h2>Aulas Disponíveis</h2>
        
        <?php if (empty($videos)): ?>
            <div class="tech-card" style="width: 100%; text-align: center; background-color: #f9f9f9;">
                <p>Em breve, os vídeos e materiais desta trilha estarão disponíveis aqui.</p>
                <p>Estamos trabalhando para trazer o melhor conteúdo para você!</p>
            </div>
        <?php else: ?>
            <?php foreach ($videos as $video): ?>
    <a href="<?php echo htmlspecialchars($video['caminho_arquivo']); ?>" target="_blank" class="tech-card-link">
        <div class="tech-card video-card">
            <h4>🎬 <?php echo htmlspecialchars($video['titulo']); ?></h4>
            <p><?php echo htmlspecialchars($video['descricao']); ?></p>
        </div>
    </a>
<?php endforeach; ?>
        <?php endif; ?>

    </section>
</body>
</html>