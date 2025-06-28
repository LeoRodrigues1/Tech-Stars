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
            echo "<p class='success'>1. Banco de dados verificado/criado.</p>";

            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // --- Estrutura da Tabela USUARIOS ---
            $pdo->exec("
            CREATE TABLE IF NOT EXISTS `usuarios` (
                `id` INT AUTO_INCREMENT PRIMARY KEY, `nome` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL UNIQUE,
                `senha_hash` VARCHAR(255) NOT NULL, `tipo` ENUM('aluna', 'admin') NOT NULL DEFAULT 'aluna',
                `data_nascimento` DATE, `genero` VARCHAR(50)
            );");
            echo "<p class='success'>2. Tabela `usuarios` verificada/criada.</p>";

            // --- Estrutura e Dados da Tabela TRILHAS ---
            $pdo->exec("
            CREATE TABLE IF NOT EXISTS `trilhas` (
              `id` INT AUTO_INCREMENT PRIMARY KEY, `nome` VARCHAR(100) NOT NULL, `descricao` TEXT NULL DEFAULT NULL,
              `slug` VARCHAR(100) NOT NULL UNIQUE
            );");
            $pdo->exec("TRUNCATE TABLE `trilhas`;");
            $pdo->exec("
            INSERT INTO `trilhas` (`id`, `nome`, `descricao`, `slug`) VALUES
              (1, 'Programação', 'Aprenda a construir soluções do zero, dando vida a ideias e resolvendo problemas complexos através da escrita de código.', 'programacao'),
              (2, 'Front-End', 'Seja a arquiteta da web! Transforme designs em interfaces interativas e bonitas que as pessoas usarão todos os dias.', 'frontend'),
              (3, 'Data Science', 'Descubra os segredos escondidos nos dados. Aprenda a coletar, analisar e visualizar informações para contar histórias.', 'dados'),
              (4, 'Inteligência Artificial', 'Ensine as máquinas a aprender. Explore a fronteira da tecnologia, criando sistemas que podem prever e automatizar tarefas.', 'ia'),
              (5, 'DevOps', 'Construa pontes entre o desenvolvimento e a infraestrutura. Aprenda a automatizar processos e garantir que as aplicações rodem de forma rápida e segura.', 'devops'),
              (6, 'UX & Design', 'Coloque-se no lugar do usuário. Aprenda a pesquisar, projetar e prototipar experiências que sejam fáceis e prazerosas de usar.', 'ux'),
              (7, 'Mobile', 'Leve suas ideias para a palma da mão. Aprenda a desenvolver aplicativos para celulares Android e iOS.', 'mobile'),
              (8, 'Gestão e Inovação', 'Transforme ideias em realidade. Desenvolva habilidades de liderança e aprenda métodos ágeis para gerenciar projetos.', 'gestao');");
            echo "<p class='success'>3. Tabela `trilhas` verificada e populada.</p>";
            
            // --- Estrutura e Dados da Tabela VIDEOS ---
            $pdo->exec("
            CREATE TABLE IF NOT EXISTS `videos` (
              `id` INT AUTO_INCREMENT PRIMARY KEY, `trilha_id` INT NOT NULL, `titulo` VARCHAR(255) NOT NULL,
              `descricao` TEXT, `caminho_arquivo` TEXT NOT NULL, `data_upload` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              FOREIGN KEY (`trilha_id`) REFERENCES `trilhas`(`id`) ON DELETE CASCADE
            );");
            $pdo->exec("TRUNCATE TABLE `videos`;");
            $pdo->exec("
            INSERT INTO `videos` (`trilha_id`, `titulo`, `descricao`, `caminho_arquivo`) VALUES
                (1, 'Introdução à Lógica de Programação', 'Aprenda os conceitos fundamentais que formam a base de toda programação.', 'https://www.youtube.com/watch?v=8mei6uVttho'),
                (1, 'Python para Iniciantes: Primeiros Passos', 'Um curso prático para quem nunca programou, ensinando a instalar e a escrever seus primeiros scripts.', 'https://www.youtube.com/watch?v=S9uPNppGsGo'),
                (1, 'Estruturas de Dados Essenciais', 'Entenda o que são listas, pilhas, filas e dicionários e como usá-los para organizar seus dados.', 'https://www.youtube.com/watch?v=P_mM-6g6a7g'),
                (2, 'HTML5 Semântico: A Base de Tudo', 'Construa a estrutura de suas páginas web da maneira correta, utilizando as tags semânticas.', 'https://www.youtube.com/watch?v=463SqTGG_I'),
                (2, 'CSS com Flexbox e Grid', 'Aprenda as duas ferramentas mais poderosas do CSS moderno para criar layouts responsivos.', 'https://www.youtube.com/watch?v=KbjLtEgmZ_E'),
                (2, 'JavaScript Básico: Manipulando o DOM', 'Dê interatividade às suas páginas aprendendo como o JavaScript pode selecionar e modificar elementos HTML.', 'https://www.youtube.com/watch?v=i6Oi-YtXnAU'),
                (3, 'SQL para Análise de Dados', 'Domine o SELECT! Aprenda a extrair, filtrar e agregar dados de bancos de dados relacionais.', 'https://www.youtube.com/watch?v=B_E4J_a02s'),
                (3, 'Introdução ao Power BI', 'Crie seus primeiros dashboards interativos e transforme dados brutos em insights visuais poderosos.', 'https://www.youtube.com/watch?v=2K32Jj_hJqs'),
                (3, 'Fundamentos de Estatística para Dados', 'Entenda os conceitos de média, mediana, desvio padrão e como eles são cruciais para a ciência de dados.', 'https://www.youtube.com/watch?v=d_q9Y_upD4'),
                (4, 'O que é Inteligência Artificial?', 'Uma visão geral sobre os diferentes tipos de IA, como Machine Learning e Deep Learning.', 'https://www.youtube.com/watch?v=9g32v7bL4vI'),
                (4, 'Machine Learning: Regressão Linear', 'Entenda seu primeiro modelo de Machine Learning, prevendo valores contínuos a partir de dados históricos.', 'https://www.youtube.com/watch?v=JcE_fig-I'),
                (4, 'Redes Neurais: Como o Cérebro Digital Pensa', 'Uma introdução conceitual sobre como as redes neurais funcionam, inspiradas no cérebro humano.', 'https://www.youtube.com/watch?v=Jrg9KxG2V6E'),
                (5, 'Docker para Desenvolvedores', 'Aprenda a criar e gerenciar contêineres, empacotando suas aplicações para que rodem em qualquer lugar.', 'https://www.youtube.com/watch?v=0kG1vyM-Lg'),
                (5, 'CI/CD com GitHub Actions', 'Automatize o teste e o deploy de suas aplicações diretamente a partir do seu repositório no GitHub.', 'https://www.youtube.com/watch?v=r_4sX7gD6o'),
                (5, 'Introdução à Nuvem AWS', 'Conheça os principais serviços da Amazon Web Services, como EC2 e S3.', 'https://www.youtube.com/watch?v=a9__D53Wsus'),
                (6, 'Os Princípios do Design Visual', 'Aprenda sobre contraste, hierarquia, balanço e como criar interfaces visualmente agradáveis.', 'https://www.youtube.com/watch?v=B5uR3-Fv2e4'),
                (6, 'Jornada do Usuário e Personas', 'Entenda como mapear a experiência do seu usuário e criar personas para guiar suas decisões de design.', 'https://www.youtube.com/watch?v=9zGZk_6Z_gY'),
                (6, 'Prototipação com Figma', 'Aprenda a usar a ferramenta líder de mercado para criar protótipos interativos de suas ideias.', 'https://www.youtube.com/watch?v=63zJi9K5DE'),
                (7, 'Desenvolvimento com Flutter: Setup Inicial', 'Prepare seu ambiente e crie seu primeiro \"Hello World\" com o framework da Google.', 'https://www.youtube.com/watch?v=I6y-b4I-24o'),
                (7, 'Construindo Layouts em Flutter', 'Entenda a filosofia de \"tudo é um widget\" e aprenda a construir telas usando Rows, Columns e Containers.', 'https://www.youtube.com/watch?v=C2p7d4M9T4k'),
                (7, 'State Management Básico com StatefulWidget', 'Gerencie o estado de seus componentes para criar aplicações dinâmicas.', 'https://www.youtube.com/watch?v=Zf_s2_6y3Wc'),
                (8, 'Metodologias Ágeis: Scrum e Kanban', 'Entenda os frameworks mais populares para gestão de projetos de tecnologia.', 'https://www.youtube.com/watch?v=o_hCgYuv-bE'),
                (8, 'De Estagiária a Líder: Habilidades de Liderança', 'Desenvolva as soft skills necessárias para crescer na carreira, como comunicação e feedback.', 'https://www.youtube.com/watch?v=hJ3VTdDkC5Y'),
                (8, 'MVP: Como Validar sua Ideia de Startup', 'Aprenda o conceito de Produto Mínimo Viável e como usá-lo para testar sua ideia de negócio.', 'https://www.youtube.com/watch?v=fWiiS_s3A2');
            ");
            echo "<p class='success'>4. Tabela `videos` verificada e populada com URLs de exemplo.</p>";

            // --- Criação do Usuário Admin ---
            $email_teste = 'teste@techstars.com';
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email_teste]);
            if ($stmt->rowCount() == 0) {
                $senha_hash = password_hash('123456', PASSWORD_DEFAULT);
                $sql_user = "INSERT INTO usuarios (nome, email, senha_hash, tipo) VALUES (?, ?, ?, ?)";
                $stmt_insert = $pdo->prepare($sql_user);
                $stmt_insert->execute(['Usuário Admin Teste', $email_teste, $senha_hash, 'admin']);
                echo "<p class='success'>5. Usuário de teste admin criado.</p>";
            } else {
                echo "<p>5. Usuário de teste já existe.</p>";
            }

            echo "<h2>✅ Instalação concluída!</h2>";
            echo "<a href='index.php'>Ir para a Página de Login</a>";
            echo "<p class='error' style='margin-top: 20px;'><strong>Atenção:</strong> Por segurança, apague este arquivo (`setup.php`) após a instalação.</p>";

        } catch (PDOException $e) {
            echo "<p class='error'>❌ Ocorreu um erro: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>