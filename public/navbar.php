
<?php 
include_once '../src/config/init.php';

// Conectar ao banco e buscar categorias reais
$conn = connectBanco();
$categorias = mysqli_query($conn, "SELECT * FROM categorias");
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
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
          <a href="../usuarios/login.php" class="btn btn-warning">Entrar</a>
        <?php endif; ?>
      </span>

      <?php if (isLoggedIn()): ?>
      <span class="navbar-text me-3">
        <a href="../public/carrinho.php" class="btn btn-light"> Carrinho </a>
      </span>
      <span class="navbar-text">
        <a href="../usuarios/logout.php" class="btn btn-dark text-white">Sair</a>
      </span>
      <?php endif; ?>
    </div>
  </div>
</nav>
