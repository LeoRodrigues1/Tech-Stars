<?php
session_start();
require '../conexao.php';

// Guardião triplo: verifica se é admin, se está logado e se um ID foi passado.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin' || !isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$video_id = $_GET['id'];

try {
    // Prepara e executa o comando para deletar o vídeo com o ID específico
    $stmt = $pdo->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->execute([$video_id]);

    // Redireciona de volta para a página de gerenciamento com uma mensagem de sucesso
    header('Location: gerenciar_videos.php?status=excluido');
    exit;

} catch (PDOException $e) {
    // Em caso de erro, pode redirecionar com uma mensagem de erro
    // (Opcional, mas boa prática)
    die("Erro ao excluir o vídeo: " . $e->getMessage());
}
?>