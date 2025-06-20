<?php
include_once __DIR__ . '/../src/config/init.php';
$conexao = connectBanco();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_produto'])) {
    $id = $_POST['id'];
    $stmt = $conexao->prepare("DELETE FROM produtos WHERE idProdutos = ?");
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
  <title>Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php if(isAdmin()): ?>
  <?php include __DIR__ . '/../public/navbar.php'; ?>
  <?php include_once __DIR__ . '/../src/config/mensagem.php'; ?>

  <div class="container text-white">
    <h1 class="mt-5">Gerenciador de Produtos</h1>
    <p class="lead">Acesso permitido somente a Admins.</p>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Lista de Produtos
            <a href="../admin/produto_create.php" class="btn btn-dark float-end">Adicionar produtos</a>
          </h4>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Raridade</th>
                <th>Universo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $sql = "SELECT produtos.idProdutos, produtos.nome, produtos.preco, produtos.imagem, categorias.nome AS categoria, raridades.nivel AS raridade, universos.nome AS universo
                FROM produtos
                JOIN categorias ON produtos.idCategorias = categorias.idCategoria
                JOIN raridades ON produtos.idRaridades = raridades.idRaridades
                JOIN universos ON produtos.idUniversos = universos.idUniversos";

                $result = mysqli_query($conexao, $sql);
                while($produto = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td>
                    <?php if ($produto['imagem']): ?>
                      <img src="../uploads/<?= $produto['imagem'] ?>" width="60">
                    <?php else: ?>
                      Sem imagem
                    <?php endif; ?>
                  </td>
                  <td><?= $produto['nome'] ?></td>
                  <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                  <td><?= $produto['categoria'] ?></td>
                  <td><?= $produto['raridade'] ?></td>
                  <td><?= $produto['universo'] ?></td>
                  <td>
                    <a href="produto_edit.php?id=<?= $produto['idProdutos'] ?>" class="btn btn-warning btn-sm">Editar</a>

                    <form action="" method="POST" class="d-inline">
                      <input type="hidden" name="id" value="<?= $produto['idProdutos'] ?>">
                      <button type="submit" name="delete_produto" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?')">
                        Excluir
                    </button>
                  </form>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?php else: ?>
  <div class="container text-center mt-5">
    <h1 class="text-danger">Acesso Negado</h1>
    <p class="text-white">Você não tem permissão para acessar esta página.</p>
  </div>
<?php endif; ?>

</body>
</html>
