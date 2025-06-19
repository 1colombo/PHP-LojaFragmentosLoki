<?php
include_once __DIR__ . '/../src/config/init.php';
include_once __DIR__ . '/../src/config/mensagem.php';

$conn = connectBanco();

// Inicializa variáveis
$nome = $preco = $imagem = "";
$mensagem = "";


//Formulário de Cadastro conectando ao banco de dados
// Se clicou no botão "Registrar"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $nome    = trim($_POST['nome'] ?? '');
    $preco   = trim($_POST['preco'] ?? '');
    $imagem  = trim($_POST['imagem'] ?? '');
    
    if (
        empty($nome) || empty($preco) || empty($imagem) 
    ) {
        $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
    } else {
          $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, imagem)
                                  VALUES (?, ?, ?)");
          $stmt->bind_param("ssssssssss", $nome,$preco, $imagem);

          if ($stmt->execute()) {
              $_SESSION['mensagem'] = "Produtos cadastrado com sucesso!";
              header("Location: ../admin/gerenciar_produto.php");
              exit();
          } else {
              $_SESSION['mensagem'] = "Erro ao cadastrar: " . $stmt->error;
          }
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
<div class="container py-5">
    <h1 class="text-white">Cadastro de Produtos</h1>
    <?php include_once __DIR__ . '/../src/config/mensagem.php';?>
    <form method="POST" class="text-white">
      <div class="mb-3 w-75">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($nome) ?>">
      </div>
      <div class="mb-3 w-75">
        <label class="form-label">Preço</label>
        <input type="text" class="form-control" name="preco" value="<?= htmlspecialchars($preco) ?>">
      </div>
      <div class="mb-3 w-75">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control" name="cpf" value="<?= htmlspecialchars($cpf) ?>">
      </div>
      <div class="mb-3 w-75">
        <label class="form-label">Imagem</label>
        <input type="image" class="form-control" name="imagem" value="<?= htmlspecialchars($imagem) ?>">
      </div>
      <div class="mb-3">
        <button type="submit" name="registrar" class="btn btn-success">Cadastrar</button>
      </div>
    </form>
    <div class="mb-3">
        <a href="gerenciar_produtos.php" class="btn btn-secondary">Voltar</a>
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