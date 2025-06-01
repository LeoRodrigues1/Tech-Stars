<?php
session_start();

?>

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
      </ul>

      <a class="cta-button" href="index.php">Entrar</a>
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
    <div class="tech-card">💻 <strong>PROGRAMAÇÃO</strong><br>Lógica, Python, PHP, Java, C, IoT...</div>
    <div class="tech-card">🎨 <strong>FRONT-END</strong><br>HTML, CSS, JS, React, jQuery...</div>
    <div class="tech-card">📊 <strong>DATA SCIENCE</strong><br>SQL, BI, Estatística, Excel...</div>
    <div class="tech-card">🤖 <strong>INTELIGÊNCIA ARTIFICIAL</strong><br>IA para programação e dados...</div>
    <div class="tech-card">🔐 <strong>DEVOPS</strong><br>AWS, Docker, Azure, Segurança...</div>
    <div class="tech-card">🖌 <strong>UX & DESIGN</strong><br>UX, Motion, 3D, Prototipação...</div>
    <div class="tech-card">📱 <strong>MOBILE</strong><br>Flutter, Android, Kotlin, iOS...</div>
    <div class="tech-card">🚀 <strong>GESTÃO E INOVAÇÃO</strong><br>Agile, Liderança, Startups...</div>
  </section>

</body>
</html>
