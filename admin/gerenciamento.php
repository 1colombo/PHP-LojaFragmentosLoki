<?php 
include_once __DIR__ . '/../src/config/init.php';
$conexao = connectBanco();

// Deletar Usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_usuario'])) {
    $id = $_POST['id'];
    $stmt = $conexao->prepare("DELETE FROM user WHERE idUser = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['mensagem'] = 'Usuário excluído com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao excluir usuário.';
    }
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
    <?php if(isAdmin()): ?>
    <?php include __DIR__ . '/../public/navbar.php'; ?>
    <?php include_once __DIR__ . '/../src/config/mensagem.php';?>
    <div class="container text-white">
      <h1 class="mt-5" >Gerenciador de Usuários</h1>
      <p class="lead">Acesso permitido somente a Admins.</p>
    </div>
      <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Lista de Usuários
              <a href="../admin/user_create.php" class="btn btn-dark float-end">Adicionar usuário</a>
            </h4>
          </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>cpf</th>
                <th>cep</th>
                <th>tipo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM user";
              $usuarios = mysqli_query($conexao, $sql);
              if (mysqli_num_rows($usuarios) > 0) {
                foreach ($usuarios as $usuario) {
                  ?>
              <tr>
                <td><?= $usuario['idUser'] ?></td>
                <td><?= $usuario['nome'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= $usuario['cpf'] ?></td>
                <td><?= $usuario['cep'] ?></td>
                <td><?= $usuario['tipo'] ?></td>
                <td>
                  <a href="../admin/user_view.php?id=<?= $usuario['idUser'] ?>" class="btn btn-dark btn-sm">Visualizar</a>

                  <a href="../admin/user_edit.php?id=<?= $usuario['idUser'] ?>" class="btn btn-dark btn-sm">Editar</a>
                  
                  <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= $usuario['idUser'] ?>">
                    <button type="submit" name="delete_usuario" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?')">
                      Excluir
                    </button>
                  </form>
                </td>
              </tr>
              <?php
                }
              } else {
                echo "<tr><td colspan='4'>Nenhum usuário encontrado</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <?php else: ?>
    <div class="container text-center mt-5">
      <h1 class="text-danger">Acesso Negado</h1>
      <p class="text-white">Você não tem permissão para acessar esta página.</p>
    </div>
  <?php endif; ?>
  </body>
</html>