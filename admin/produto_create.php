<?php
include_once __DIR__ . '/../src/config/init.php';

$conn = connectBanco();

// Busca dados das tabelas auxiliares
$categorias = mysqli_query($conn, "SELECT * FROM categorias");
$raridades = mysqli_query($conn, "SELECT * FROM raridades");
$universos = mysqli_query($conn, "SELECT * FROM universos");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = trim($_POST['nome']);
    $preco      = floatval($_POST['preco']);
    $id_categoria = intval($_POST['id_categoria']);
    $id_raridade = intval($_POST['id_raridade']);
    $id_universo = intval($_POST['id_universo']);

    // Upload da imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $nomeImagem = time() . '_' . basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../uploads/' . $nomeImagem);
        $imagem = $nomeImagem;
    }

    $sql = "INSERT INTO produtos (nome, preco, idCategorias, idRaridades, idUniversos, imagem)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdiiis", $nome, $preco, $id_categoria, $id_raridade, $id_universo, $imagem);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: gerenciar_produtos.php");
        exit();
    } else {
        echo "Erro ao cadastrar produto: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php if(isAdmin()): ?>
  <div class="container py-5 text-white">
    <h1 class="mb-4 ">Adicionar Produto</h1>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3 w-75">
        <label class="form-label">Nome do Produto</label>
        <input type="text" class="form-control" name="nome" required>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" name="preco" required>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Categoria</label>
        <select class="form-select" name="id_categoria" required>
          <option value="">Selecione</option>


          <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
            <option value="<?= $categoria['idCategoria'] ?>"><?= $categoria['nome'] ?></option>
          <?php endwhile; ?>

          
        </select>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Raridade</label>
        <select class="form-select" name="id_raridade" required>
          <option value="">Selecione</option>
          <?php while ($raridade = mysqli_fetch_assoc($raridades)): ?>
            <option value="<?= $raridade['idRaridades'] ?>"><?= $raridade['nivel'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Universo</label>
        <select class="form-select" name="id_universo" required>
          <option value="">Selecione</option>
          <?php while ($universo = mysqli_fetch_assoc($universos)): ?>
            <option value="<?= $universo['idUniversos'] ?>"><?= $universo['nome'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Imagem (opcional)</label>
        <input type="file" class="form-control" name="imagem">
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
      <a href="produto_index.php" class="btn btn-secondary ms-2">Voltar</a>
    </form>
  </div>
  <?php else: ?>
    <div class="container text-center mt-5">
      <h1 class="text-danger">Acesso Negado</h1>
      <p class="text-white">Você não tem permissão para acessar esta página.</p>
    </div>
  <?php endif; ?>
</body>
</html>
