<?php 
include_once __DIR__ . '/../src/config/init.php';
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Fragmentos de Loki</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">Variantes do Loki</a></li>
            <li><a class="dropdown-item" href="#">Dispositivos AVT</a></li>
            <li><a class="dropdown-item" href="#">Artefatos Temporais</a></li>
          </ul>
        </li>
        <li class="nav-item">
        <?php if(isAdmin()): ?>
          <a class="nav-link active" aria-current="page" href="#">Área Admin</a>
        <?php endif; ?>
        </li>
      </div>
      </ul>
      <span class="navbar-text">
        <?php if (isLoggedIn()): ?>
          Olá, <?= htmlspecialchars($_SESSION['nome']) ?>!
        <?php else: ?>
          <a href="../usuarios/login.php" class="btn btn-warning">Entrar</a>
        <?php endif; ?>
      <span class="navbar-text">
        <a href="../usuarios/logout.php" class="btn btn-dark text-white">Sair</a>
      </span>
    </div>
  </div>
</nav>