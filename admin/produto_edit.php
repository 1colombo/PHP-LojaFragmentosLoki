<?php
include_once __DIR__ . '/../src/config/init.php';
include_once __DIR__ . '/../src/config/mensagem.php';

$conn = connectBanco();

$categorias = mysqli_query($conn, "SELECT * FROM categorias");
$raridades = mysqli_query($conn, "SELECT * FROM raridades");
$universos = mysqli_query($conn, "SELECT * FROM universos");


if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "ID do produto não fornecido.";
    header("Location: gerenciar_produtos.php");
    exit();
}

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM produtos WHERE idProdutos = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows !== 1) {
    $_SESSION['mensagem'] = "Produto não encontrado.";
    header("Location: gerenciar_produtos.php");
    exit();
}

$produto = $result->fetch_assoc();

// Buscando categorias, raridades e universos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $id_categoria = intval($_POST['id_categoria']);
    $id_raridade = intval($_POST['id_raridade']);
    $id_universo = intval($_POST['id_universo']);

    $imagem = $produto['imagem']; // mantém a imagem antiga se não trocar

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $nomeImagem = time() . '_' . basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../uploads/' . $nomeImagem);
        $imagem = $nomeImagem;
    }
    $stmt = $conn->prepare("UPDATE produtos SET nome=?, preco=?, idCategorias=?, idRaridades=?, idUniversos=?, imagem=? WHERE idProdutos=?");
    $stmt->bind_param("sdiiisi", $nome, $preco, $id_categoria, $id_raridade, $id_universo, $imagem, $id);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
        header("Location: gerenciar_produtos.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar produto: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container py-5 text-white">
    <h1 class="mb-4">Editar Produto</h1>
    <form method="POST" enctype="multipart/form-data">

      <div class="mb-3 w-75">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Categoria</label>
        <select class="form-select" name="id_categoria">
          <option value="">Selecione</option>
          <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
            <option value="<?= $categoria['idCategoria'] ?>" 
              <?= $categoria['idCategoria'] == $produto['idCategorias'] ? 'selected' : '' ?>>
              <?= $categoria['nome'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>


      <div class="mb-3 w-75">
        <label class="form-label">Raridade</label>
        <select class="form-select" name="id_raridade">
          <option value="">Selecione</option>
          <?php while ($raridade = mysqli_fetch_assoc($raridades)): ?>
            <option value="<?= $raridade['idRaridades'] ?>" 
              <?= $raridade['idRaridades'] == $produto['idRaridades'] ? 'selected' : '' ?>>
              <?= $raridade['nivel'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Universo</label>
        <select class="form-select" name="id_universo">
          <option value="">Selecione</option>
          <?php while ($universo = mysqli_fetch_assoc($universos)): ?>
            <option value="<?= $universo['idUniversos'] ?>" 
              <?= $universo['idUniversos'] == $produto['idUniversos'] ? 'selected' : '' ?>>
              <?= $universo['nome'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Imagem</label>
        <input type="file" class="form-control" name="imagem">
        <?php if ($produto['imagem']): ?>
          <small>Imagem atual: <?= $produto['imagem'] ?></small>
        <?php endif; ?>
      </div>

      <button type="submit" name="atualizar" class="btn btn-primary">Salvar</button>
      <a href="gerenciar_produtos.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
</body>
</html>