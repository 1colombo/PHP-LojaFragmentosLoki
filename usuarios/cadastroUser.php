<?php
session_start();

$cep = $rua = $bairro = $cidade = $estado = "";
$nome = $email = $cpf = "";

// Se o botão "Buscar CEP" foi pressionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar_cep'])) {
    $cep = preg_replace('/\D/', '', $_POST['cep']);
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    if (strlen($cep) === 8) {
        $url = "https://viacep.com.br/ws/$cep/json/";
        $resposta = file_get_contents($url);
        $dados = json_decode($resposta, true);
        if (!isset($dados['erro'])) {
            $rua    = $dados['logradouro'] ?? '';
            $bairro = $dados['bairro'] ?? '';
            $cidade = $dados['localidade'] ?? '';
            $estado = $dados['uf'] ?? '';
        } else {
            echo "<p style='color:red;'>CEP não encontrado.</p>";
        }
    } else {
        echo "<p style='color:red;'>CEP inválido.</p>";
    }
}
// Se o botão de cadastro foi pressionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    // Redireciona para createUser.php com os dados
    header("Location: createUser.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="container py-5">
    <h1 class="text-white">Cadastro de Usuários</h1>

    <form method="POST" class="text-white">

      <div class="mb-3 w-75">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($nome) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control" name="cpf" value="<?= htmlspecialchars($cpf) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">CEP</label>
        <div class="d-flex">
          <input type="text" class="form-control me-2" name="cep" value="<?= htmlspecialchars($cep) ?>">
          <button type="submit" name="buscar_cep" class="btn btn-outline-info">Buscar CEP</button>
        </div>
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Rua</label>
        <input type="text" class="form-control" name="rua" value="<?= htmlspecialchars($rua) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Bairro</label>
        <input type="text" class="form-control" name="bairro" value="<?= htmlspecialchars($bairro) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control" name="cidade" value="<?= htmlspecialchars($cidade) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Estado</label>
        <input type="text" class="form-control" name="estado" value="<?= htmlspecialchars($estado) ?>">
      </div>

      <div class="mb-3 w-75">
        <label class="form-label">Senha</label>
        <input type="password" class="form-control" name="password">
      </div>

      <div class="mb-3">
        <button type="submit" name="registrar" class="btn btn-success">Registrar</button>
      </div>
    </form>
  </div>
</body>
</html>
