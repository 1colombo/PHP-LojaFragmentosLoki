<?php 
session_start();
include_once __DIR__ . '/../src/config/init.php';
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
      <h1 class="mt-5" >Gerenciador de Produtos</h1>
      <p class="lead">Acesso permitido somente a Admins.</p>
      <?php if (isLoggedIn()): ?>
        <p class="mt-3">Olá, <?= htmlspecialchars($_SESSION['nome'])?>! </p>
        <p class="mt-3">Tipo: <?= htmlspecialchars($_SESSION['tipo'])?>! </p>
      </div>
      <?php endif; ?>
  </body>
</html>