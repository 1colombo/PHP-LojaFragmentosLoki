<?php 
include_once '../src/config/init.php';

$conn = connectBanco();

$produtos = mysqli_query($conn, "
  SELECT produtos.idProdutos, produtos.nome, produtos.preco, produtos.imagem, categorias.nome AS categoria, raridades.nivel AS raridade, universos.nome AS universo
  FROM produtos
  JOIN categorias ON produtos.idCategorias = categorias.idCategoria
  JOIN raridades ON produtos.idRaridades = raridades.idRaridades
  JOIN universos ON produtos.idUniversos = universos.idUniversos
");
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fragmentos de Loki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
  </head>
  <body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="container text-white">
      <h1 class="text-center mt-5" >Bem-vindo ao Fragmentos de Loki</h1>
      <p class="text-center lead">Explore o multiverso de Loki e descubra suas variantes, dispositivos da AVT e artefatos temporais.</p>
      <div class="container py-5">
        <h1 class="text-center mb-5">Produtos em Destaque</h1>
        <div class="row g-4">

          <?php while ($p = mysqli_fetch_assoc($produtos)): ?>
            <div class="col-md-4">
              <div class="card h-100">
                <img src="../uploads/<?= htmlspecialchars($p['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                  <p class="card-text">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                  <p class="card-text"><small class="text-muted"><?= $p['categoria'] ?> - <?= $p['raridade'] ?> - <?= $p['universo'] ?></small></p>
                  <a href="#" class="btn btn-primary w-100">Ver mais</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

        </div>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>