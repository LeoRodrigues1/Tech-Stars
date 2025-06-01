<?php
session_start();

// Só aceitar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// Recebe e valida email
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'];

if (!$email) {
    header('Location: login.php?error=email_invalido');
    exit;
}

// Usuário padrão fixo para teste
$usuarioTeste = [
    'id' => 1,
    'nome' => 'Usuário Teste',
    'email' => 'teste@techstars.com',
    'senha_hash' => password_hash('123456', PASSWORD_DEFAULT)
];

// Verifica email e senha
if ($email === $usuarioTeste['email'] && password_verify($senha, $usuarioTeste['senha_hash'])) {
    // Login ok: cria sessão
    $_SESSION['usuario_id'] = $usuarioTeste['id'];
    $_SESSION['usuario_nome'] = $usuarioTeste['nome'];

    header('Location: dashboard.php');
    exit;
} else {
    header('Location: login.php?error=login_invalido');
    exit;
}
