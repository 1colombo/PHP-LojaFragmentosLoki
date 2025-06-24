
<?php 
include_once '../src/config/init.php';

// Conectar ao banco e buscar categorias reais
$conn = connectBanco();
$categorias = mysqli_query($conn, "SELECT * FROM categorias");
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fragmentos de Loki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .navbar {
      background-color: #2c2c2c;
    }
    .navbar, .navbar a, .navbar-brand, .navbar-nav .nav-link, .navbar-text {
      color: #00ff99 !important;
    }
    .btn:hover {
      background-color: #00ff99 !important;
      color: #2c2c2c !important;
    }
    
  </style>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="../public/index.php">Fragmentos de Loki</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../public/index.php">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="categoriasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="categoriasDropdown">
            <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
              <li>
                <a class="dropdown-item" href="../public/index.php?categoria=<?= $cat['idCategoria'] ?>">
                  <?= htmlspecialchars($cat['nome']) ?>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </li>

        <?php if(isAdmin()): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../admin/gerenciamento.php" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Áreas Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="adminDropdown">
            <li><a class="dropdown-item" href="../admin/gerenciamento.php">Gerenciar Usuários</a></li>
            <li><a class="dropdown-item" href="../admin/gerenciar_produtos.php">Gerenciar Produtos</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>

      <span class="navbar-text me-3">
        <?php if (isLoggedIn()): ?>
          Olá, <?= htmlspecialchars($_SESSION['nome']) ?>!
        <?php else: ?>
          <a href="../usuarios/login.php" class="btn btn-dark">Entrar</a>
        <?php endif; ?>
      </span>

      <?php if (isLoggedIn()): ?>
      <span class="navbar-text me-3">
        <a href="../public/carrinho.php" class="btn btn-dark"> Carrinho </a>
      </span>
      <span class="navbar-text">
        <a href="../usuarios/logout.php" class="btn btn-dark text-white">Sair</a>
      </span>
      <?php endif; ?>
    </div>
  </div>
</nav>
