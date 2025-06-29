<?php
session_start();
require '../conexao.php';

// Guardião da página: apenas admins logados podem acessar.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Busca todos os vídeos, juntando com o nome da trilha para fácil identificação.
$stmt = $pdo->query("
    SELECT videos.id, videos.titulo, trilhas.nome AS trilha_nome
    FROM videos
    JOIN trilhas ON videos.trilha_id = trilhas.id
    ORDER BY trilhas.nome, videos.titulo
");
$videos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Vídeos</title>
    <link rel="stylesheet" href="../assets/css/style_dashboard.css">
    <style>
        /* Estilos para a tabela de gerenciamento */
        .tabela-gerenciamento { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .tabela-gerenciamento th, .tabela-gerenciamento td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .tabela-gerenciamento th { background-color:rgba(97, 97, 97, 0.84); }
        .tabela-gerenciamento tr:nth-child(even) { background-color:rgba(97, 97, 97, 0.84); }
        .btn-excluir { background-color: #dc3545; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; }
    </style>
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
            <h1>Gerenciar Vídeos</h1>
            <p>Aqui você pode ver e excluir os vídeos existentes na plataforma.</p>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'excluido'): ?>
                <p style="color: green;">Vídeo excluído com sucesso!</p>
            <?php endif; ?>

            <table class="tabela-gerenciamento">
                <thead>
                    <tr>
                        <th>Título do Vídeo</th>
                        <th>Trilha</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($videos) > 0): ?>
                        <?php foreach ($videos as $video): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($video['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($video['trilha_nome']); ?></td>
                                <td>
                                    <a href="deletar_video.php?id=<?php echo $video['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este vídeo? Esta ação não pode ser desfeita.');">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Nenhum vídeo encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>