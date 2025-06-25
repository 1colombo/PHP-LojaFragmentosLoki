<?php 
include_once '../src/config/init.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}


$conn = connectBanco();

$produtos = mysqli_query($conn, "
  SELECT produtos.idProdutos, produtos.nome, produtos.preco, produtos.imagem, categorias.nome AS categoria, raridades.nivel AS raridade, universos.nome AS universo
  FROM produtos
  JOIN categorias ON produtos.idCategorias = categorias.idCategoria
  JOIN raridades ON produtos.idRaridades = raridades.idRaridades
  JOIN universos ON produtos.idUniversos = universos.idUniversos
");

$categoriaSelecionada = isset($_GET['categoria']) ? intval($_GET['categoria']) : null;

// Monta a consulta com ou sem filtro
if ($categoriaSelecionada) {
    $stmt = $conn->prepare("SELECT produtos.*, categorias.nome AS categoria_nome, raridades.nivel AS raridade, universos.nome AS universo 
                FROM produtos
                JOIN categorias ON produtos.idCategorias = categorias.idCategoria
                JOIN raridades ON produtos.idRaridades = raridades.idRaridades
                JOIN universos ON produtos.idUniversos = universos.idUniversos
                  WHERE produtos.idCategorias = ?");
    $stmt->bind_param("i", $categoriaSelecionada);
} else {
    $stmt = $conn->prepare("SELECT produtos.*, categorias.nome AS categoria_nome, raridades.nivel AS raridade, universos.nome AS universo 
                FROM produtos
                JOIN categorias ON produtos.idCategorias = categorias.idCategoria
                JOIN raridades ON produtos.idRaridades = raridades.idRaridades
                JOIN universos ON produtos.idUniversos = universos.idUniversos");
}

$stmt->execute();
$result = $stmt->get_result();
$produtos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fragmentos de Loki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <style>
    body {
    color: #00ffcc;
    font-family: 'Cinzel', serif;
  }

  .card {
    border: 1px solid #00ffcc;
    color: #00ffaa !important;
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card-body{
    background-color: #1e1e1e;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 20px #00ffaa;
  }

  .card-title {
    color: #00ffaa;
    font-size: 1.2rem;
  }

  .card-text {
    color: #00ffaa;
  }

  .small {
    color: #00ffaa !important;
  }

  .card-text small {
    color: #00ffaa;
  }

  .card-img-top {
    background-color:rgb(63, 63, 63);
  }

  .btn-success {
    background-color: #00cc99;
    border-color: #00cc99;
  }

  .btn-success:hover {
    background-color: #00ffaa;
    border-color: #00ffaa;
  }


    
  </style>
  </head>
  <body>
    <?php include __DIR__ . '/navbar.php'; ?>
    <div class="container" id="main-content">
      <h1 class="text-center mt-5" >Bem-vindo ao Fragmentos de Loki</h1>
      <p class="text-center lead">Explore o multiverso de Loki e descubra suas variantes, dispositivos da AVT e artefatos temporais.</p>
      <div class="container py-5">
        <h1 class="text-center mb-5">Produtos em Destaque</h1>
        <div class="row g-4">

          <?php foreach ($produtos as $produto): ?>
            <div class="col-md-4" id="card-body">
              <div class="card h-100">
                <img src="../uploads/<?= htmlspecialchars($produto['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($produto['nome']) ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h5>
                  <p class="card-text">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                  <p class="card-text"><small><?= $produto['categoria_nome'] ?> - <?= $produto['raridade'] ?> - <?= $produto['universo'] ?></small></p>
                  <form method="POST" action="adicionar_carrinho.php">
                    <input type="hidden" name="id" value="<?= $produto['idProdutos'] ?>">
                    <input type="hidden" name="nome" value="<?= $produto['nome'] ?>">
                    <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">
                    <?php if(isLoggedIn()): ?>
                      <button type="submit" class="btn btn-sm btn-success mt-2">Adicionar ao carrinho</button>
                    <?php endif?>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>