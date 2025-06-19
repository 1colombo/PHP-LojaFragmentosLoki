<?php
session_start();
include_once __DIR__ . '/../src/config/conexao.php';

$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);

$conn = connectBanco();

// Inicializa variáveis
$cep = $rua = $bairro = $cidade = $estado = "";
$nome = $email = $cpf = $senha = "";
$mensagem = "";

//API ViaCEP
// Se clicou no botão "Buscar CEP"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar_cep'])) {
    $cep = preg_replace('/\D/', '', $_POST['cep']);
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['password'] ?? '';

    if (strlen($cep) === 8) {
        $url = "https://viacep.com.br/ws/$cep/json/";
        $resposta = @file_get_contents($url);

        if ($resposta) {
            $dados = json_decode($resposta, true);
            if (!isset($dados['erro'])) {
                $rua    = $dados['logradouro'] ?? '';
                $bairro = $dados['bairro'] ?? '';
                $cidade = $dados['localidade'] ?? '';
                $estado = $dados['uf'] ?? '';
            } else {
                $_SESSION['mensagem'] = "CEP não encontrado.";
            }
        } else {
            $_SESSION['mensagem'] = "Erro ao buscar o CEP.";
        }
    } else {
      $_SESSION['mensagem'] = "CEP inválido.";
    }
}

//Formulário de Cadastro conectando ao banco de dados
// Se clicou no botão "Registrar"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $nome    = trim($_POST['nome'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $cpf     = trim($_POST['cpf'] ?? '');
    $senha   = $_POST['password'] ?? '';
    $cep     = trim($_POST['cep'] ?? '');
    $rua     = trim($_POST['rua'] ?? '');
    $bairro  = trim($_POST['bairro'] ?? '');
    $cidade  = trim($_POST['cidade'] ?? '');
    $estado  = trim($_POST['estado'] ?? '');
    $tipo    = 'user';

    if (
        empty($nome) || empty($email) || empty($cpf) || empty($senha) ||
        empty($cep) || empty($rua) || empty($bairro) || empty($cidade) || empty($estado)
    ) {
        $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
    } else {
        // Verifica se CPF já está cadastrado
        $verifica = $conn->prepare("SELECT idUser FROM user WHERE cpf = ?");
        $verifica->bind_param("s", $cpf);
        $verifica->execute();
        $verifica->store_result();

        if ($verifica->num_rows > 0) {
            $_SESSION['mensagem'] = "CPF já cadastrado.";
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO user (nome, email, cpf, senha, cep, rua, bairro, cidade, estado, tipo)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssss", $nome, $email, $cpf, $senha_hash, $cep, $rua, $bairro, $cidade, $estado, $tipo);

            if ($stmt->execute()) {
                $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
                header("Location: ../usuarios/login.php");
                exit();
            } else {
                $_SESSION['mensagem'] = "Erro ao cadastrar: " . $stmt->error;
            }
        }
    }
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

    <?php if (!empty($_SESSION['mensagem'])): ?>
      <div class="alert alert-warning"><?= htmlspecialchars($_SESSION['mensagem']) ?></div>
      <?php unset($_SESSION['mensagem']); endif?>

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
    <div class="mb-3">
        <a href="login.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>
</body>
</html>