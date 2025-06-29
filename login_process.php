<?php
session_start();
require 'conexao.php'; // Inclui a conexão

// 1. Garante que a requisição é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redireciona para a página inicial com uma mensagem de erro genérica
    header('Location: index.php?error=acesso_indevido');
    exit;
}

// 2. Filtra e valida o email
// trim() para remover espaços em branco no início/fim
// mb_strtolower() para converter para minúsculas (se o seu banco de dados for case-sensitive para emails)
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'] ?? ''; // Usa operador de coalescência nula para evitar warning se 'senha' não for setada


if (!$email) {
    header('Location: index.php?error=email_invalido'); // Mensagem mais específica
    exit;
}

// Verifica se a senha está vazia (opcional, mas boa prática)
if (empty($senha)) {
    header('Location: index.php?error=senha_vazia');
    exit;
}

try {
    // 3. Prepara e executa a consulta
    $sql = "SELECT id, nome, senha_hash, tipo FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]); // O email já foi filtrado/validado
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Busca como array associativo

    // 4. Verifica o usuário e a senha
    if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
        // Login bem-sucedido
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

        // Redireciona para o dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Credenciais inválidas (email não encontrado ou senha incorreta)
        header('Location: index.php?error=credenciais_invalidas'); // Mensagem mais abrangente
        exit;
    }

} catch (PDOException $e) {
    // 5. Tratamento de erro de banco de dados
    // Em um ambiente de produção, logue o erro (não mostre ao usuário)
    error_log("Erro no login (BD): " . $e->getMessage() . " - Email: " . $email);
    // Redireciona com uma mensagem de erro genérica para o usuário
    header('Location: index.php?error=erro_servidor');
    exit;
}

?>