<?php
include_once __DIR__ . '/../src/config/init.php';
include_once __DIR__ . '/../src/config/mensagem.php';

$conn = connectBanco();

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "ID do usuário não fornecido.";
    header("Location: gerenciamento.php");
    exit();
}

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM user WHERE idUser = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows !== 1) {
    $_SESSION['mensagem'] = "Usuário não encontrado.";
    header("Location: gerenciamento.php");
    exit();
}

$usuario = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    $nome   = trim($_POST['nome']);
    $email  = trim($_POST['email']);
    $cpf    = trim($_POST['cpf']);
    $tipo   = $_POST['tipo'];
    $cep    = trim($_POST['cep']);
    $rua    = trim($_POST['rua']);
    $bairro = trim($_POST['bairro']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);

    $stmt = $conn->prepare("UPDATE user SET nome=?, email=?, cpf=?, tipo=?, cep=?, rua=?, bairro=?, cidade=?, estado=? WHERE idUser=?");
    $stmt->bind_param("sssssssssi", $nome, $email, $cpf, $tipo, $cep, $rua, $bairro, $cidade, $estado, $id);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
        header("Location: gerenciamento.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar: " . $stmt->error;
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<?php if(isAdmin()): ?>
<div class="container py-5">
    <h1>Editar Usuário</h1>
    <?php include_once __DIR__ . '/../src/config/mensagem.php'; ?>
    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>">
        </div>
        
        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" value="<?= htmlspecialchars($usuario['cpf']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select">
                <option value="User" <?= $usuario['tipo'] === 'User' ? 'selected' : '' ?>>Usuário</option>
                <option value="Admin" <?= $usuario['tipo'] === 'Admin' ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control" value="<?= htmlspecialchars($usuario['cep']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Rua</label>
            <input type="text" name="rua" class="form-control" value="<?= htmlspecialchars($usuario['rua']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Bairro</label>
            <input type="text" name="bairro" class="form-control" value="<?= htmlspecialchars($usuario['bairro']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" value="<?= htmlspecialchars($usuario['cidade']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" value="<?= htmlspecialchars($usuario['estado']) ?>">
        </div>
        <button type="submit" name="atualizar" class="btn btn-success">Atualizar</button>
        <a href="gerenciamento.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php else: ?>
    <div class="container text-center mt-5">
        <h1 class="text-danger">Acesso Negado</h1>
        <p class="text-white">Você não tem permissão para acessar esta página.<p>
    </div>
<?php endif; ?>
</body>
</html>