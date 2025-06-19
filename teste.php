<!-- <?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ../usuarios/login.php");
    exit();
}
?>

<h2>Olá, <?= htmlspecialchars($_SESSION['nome']) ?>!</h2>

<?php if ($_SESSION['tipo'] === 'admin'): ?>
    <p>Você é um <strong>administrador</strong>.</p>
    <a href="adminPanel.php" class="btn btn-warning">Painel de Administração</a>
<?php else: ?>
    <p>Bem-vindo à loja, aproveite os produtos!</p>
<?php endif; ?>
<a href="/usuarios/logout.php" class="btn btn-danger">Sair</a> -->