<?php
// admin/processa_video.php
session_start();
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$trilha_id = $_POST['trilha_id'];
$video_url = filter_var($_POST['video_url'], FILTER_VALIDATE_URL);

if (!$video_url) {
    header('Location: adicionar_video.php?error=URL inválida.');
    exit;
}

try {
    $sql = "INSERT INTO videos (trilha_id, titulo, descricao, caminho_arquivo) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$trilha_id, $titulo, $descricao, $video_url]);

    header('Location: adicionar_video.php?success=1');
    exit;
} catch (PDOException $e) {
    header('Location: adicionar_video.php?error=Erro ao salvar no banco de dados.');
    exit;
}
?>