<?php 
include_once '../src/config/init.php';
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="container text-white">
      <h1 class="mt-5" >Bem-vindo ao Fragmentos de Loki</h1>
      <p class="lead">Explore o multiverso de Loki e descubra suas variantes, dispositivos da AVT e artefatos temporais.</p>
      <!-- Colocar nome user -->
      <?php if (isLoggedIn()): ?>
        <p class="mt-3">Olá, <?= htmlspecialchars($_SESSION['nome'])?>! </p>
        <p class="mt-3">Tipo: <?= htmlspecialchars($_SESSION['tipo'])?>! </p>
      </div>
      <?php endif; ?>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>