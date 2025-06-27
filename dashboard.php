<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$nome_usuario = $_SESSION['usuario_nome'];

try {
    $query = "SELECT nome, slug FROM trilhas ORDER BY id";
    $trilhas = $pdo->query($query)->fetchAll();
} catch (PDOException $e) {
    $trilhas = [];
    die("Erro ao buscar as trilhas: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<!DOCTYPE html>
<html lang="pt-br">

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Tech_Stars - Dashboard</title>
  <link rel="stylesheet" href="assets/css/style_dashboard.css">
</head>
<body>
  <nav class="navbar">
  <div class="navbar-container">
    <div class="logo">🌟 Tech Stars</div>

      <div class="search-box">
        <input type="text" placeholder="Buscar..." />
        <button>🔍</button>
      </div>

      <ul class="nav-links">
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="#">Conteúdos</a></li>
        <li><a href="#trilhas">Áreas de aprendizado</a></li>
        <?php
        if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin'): ?>
          <li><a href="admin/admin_dashboard.php" style="color: #00bfff; font-weight: bold;">Painel Admin</a></li>
        <?php endif; ?>
      </ul>

      <div class="user-info">
          <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</span>
          <a class="cta-button" href="logout.php">Sair</a>
      </div>
    </div>
  </nav>

  <section class="form-section">
    <div class="form-container">
      <h1>Construa seu futuro na <span style="color:#00bfff;">Tecnologia!</span></h1>
      <p>Explore as habilidades mais demandadas do setor e encontre sua trilha ideal para o seu crescimento profissional!</p>
      <a href="quiz.html"><button>Descubra sua trilha</button></a>
    </div>
  </section>

  <section id="trilhas" class="cards-grid">
    <h1>Áreas de Aprendizado</h1>
    <?php foreach ($trilhas as $trilha): ?>
      <a href="trilha_pagina.php?slug=<?php echo htmlspecialchars($trilha['slug']); ?>" class="tech-card-link">
        <div class="tech-card" data-slug="<?php echo htmlspecialchars($trilha['slug']); ?>">
          <strong><?php echo mb_strtoupper(htmlspecialchars($trilha['nome'])); ?></strong>
        </div>
      </a>
    <?php endforeach; ?>

    <?php if (empty($trilhas)): ?>
      <p>Nenhuma trilha de aprendizado encontrada no momento.</p>
    <?php endif; ?>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const trilhaEscolhida = localStorage.getItem("trilhaEscolhida");

        if (trilhaEscolhida) {
            const cardDestacado = document.querySelector(`.tech-card[data-slug='${trilhaEscolhida}']`);

            if (cardDestacado) {
                cardDestacado.classList.add('destaque');
                cardDestacado.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            localStorage.removeItem("trilhaEscolhida");
        }
    });
  </script>

</body>
</html>