<?php
require 'conexao.php'; // Inclui a conexão com o banco

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro.php');
    exit;
}

// 1. Receber e validar os dados
$nome = $_POST['nome'];
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$confirmacao_email = filter_var($_POST['confirmacao-email'], FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'];
$confirmacao_senha = $_POST['confirmacao-senha'];
$data_nascimento = $_POST['data-nascimento'];
$genero = $_POST['genero'];

// 2. Validar informações (adicione mais validações se quiser)
if (!$email || $email !== $confirmacao_email) {
    // Idealmente, você passaria uma mensagem de erro específica
    header('Location: cadastro.php?error=email_nao_confere');
    exit;
}

if (empty($senha) || $senha !== $confirmacao_senha) {
    header('Location: cadastro.php?error=senha_nao_confere');
    exit;
}

// 3. Criptografar a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// 4. Inserir no banco de dados
try {
    $sql = "INSERT INTO usuarios (nome, email, senha_hash, data_nascimento, genero) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senha_hash, $data_nascimento, $genero]);

    // Redireciona para o login com uma mensagem de sucesso
    header('Location: index.php?success=cadastro_ok');
    exit;

} catch (PDOException $e) {
    // Verifica se o erro é de e-mail duplicado
    if ($e->getCode() == 23000) {
        header('Location: cadastro.php?error=email_ja_existe');
    } else {
        // Outro erro de banco de dados
        die('Erro ao cadastrar: ' . $e->getMessage());
    }
}
?>