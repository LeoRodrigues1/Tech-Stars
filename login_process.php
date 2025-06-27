<?php
session_start();
require 'conexao.php'; // Inclui a conexão

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'];

if (!$email) {
    header('Location: index.php?error=email_invalido');
    exit;
}

$sql = "SELECT id, nome, senha_hash, tipo FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_tipo'] = $usuario['tipo'];

    header('Location: dashboard.php');
    exit;
} else {
    header('Location: index.php?error=login_invalido');
    exit;
}
?>