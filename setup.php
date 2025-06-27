<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Setup do Projeto Tech Stars</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; color: #333; line-height: 1.6; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .code { background: #eee; padding: 2px 6px; border-radius: 4px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assistente de Instalação Tech Stars</h1>
        <hr>
        <?php
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db_name = 'tech_stars_db';

        try {
            $pdo_init = new PDO("mysql:host=$host", $user, $pass);
            $pdo_init->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo_init->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            echo "<p class='success'>1. Banco de dados <span class='code'>$db_name</span> verificado/criado com sucesso!</p>";

            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql_usuarios = "
            CREATE TABLE IF NOT EXISTS `usuarios` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `nome` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) NOT NULL UNIQUE,
                `senha_hash` VARCHAR(255) NOT NULL,
                `tipo` ENUM('aluna', 'admin') NOT NULL DEFAULT 'aluna',
                `data_nascimento` DATE,
                `genero` VARCHAR(50)
            );";
            $pdo->exec($sql_usuarios);
            echo "<p class='success'>2. Tabela <span class='code'>usuarios</span> verificada/criada com sucesso!</p>";

            $sql_trilhas = "
            CREATE TABLE IF NOT EXISTS `trilhas` (
              `id` INT AUTO_INCREMENT PRIMARY KEY,
              `nome` VARCHAR(100) NOT NULL,
              `slug` VARCHAR(100) NOT NULL UNIQUE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $pdo->exec($sql_trilhas);

            $sql_insert_trilhas = "
            INSERT IGNORE INTO `trilhas` (`nome`, `slug`) VALUES
              ('Programação', 'programacao'),
              ('Front-End', 'frontend'),
              ('Data Science', 'dados'),
              ('Inteligência Artificial', 'ia'),
              ('DevOps', 'devops'),
              ('UX & Design', 'ux'),
              ('Mobile', 'mobile'),
              ('Gestão e Inovação', 'gestao');";
            $pdo->exec($sql_insert_trilhas);
            echo "<p class='success'>3. Tabela <span class='code'>trilhas</span> verificada e populada com sucesso!</p>";

            $sql_videos = "
            CREATE TABLE IF NOT EXISTS `videos` (
              `id` INT AUTO_INCREMENT PRIMARY KEY,
              `trilha_id` INT NOT NULL,
              `titulo` VARCHAR(255) NOT NULL,
              `descricao` TEXT,
              `caminho_arquivo` VARCHAR(255) NOT NULL,
              `data_upload` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              FOREIGN KEY (`trilha_id`) REFERENCES `trilhas`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $pdo->exec($sql_videos);
            echo "<p class='success'>4. Tabela <span class='code'>videos</span> verificada/criada com sucesso!</p>";

            $email_teste = 'teste@techstars.com';
            $senha_teste = '123456';
            $senha_hash = password_hash($senha_teste, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email_teste]);

            if ($stmt->rowCount() == 0) {
                $sql_user = "INSERT INTO usuarios (nome, email, senha_hash, tipo) VALUES (?, ?, ?, ?)";
                $stmt_insert = $pdo->prepare($sql_user);
                $stmt_insert->execute(['Usuário Admin Teste', $email_teste, $senha_hash, 'admin']);
                echo "<p class='success'>5. Usuário de teste <span class='code'>admin</span> (<span class='code'>$email_teste</span> / senha: <span class='code'>$senha_teste</span>) criado com sucesso!</p>";
            } else {
                echo "<p>5. Usuário de teste já existe. Nenhum usuário novo foi criado.</p>";
            }

            echo "<h2>✅ Instalação concluída!</h2>";
            echo "<p>Tudo pronto! Agora você já pode acessar a página principal do projeto.</p>";
            echo "<a href='index.php'>Ir para a Página de Login</a>";
            echo "<p class='error' style='margin-top: 20px;'><strong>Atenção:</strong> Por segurança, apague o arquivo <span class='code'>setup.php</span> após a instalação.</p>";

        } catch (PDOException $e) {
            echo "<p class='error'>❌ Ocorreu um erro durante a instalação:</p>";
            echo "<p class='error' style='background: #ffe8e8; padding: 10px; border-radius: 4px;'>" . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>