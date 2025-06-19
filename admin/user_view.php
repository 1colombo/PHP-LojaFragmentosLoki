<?php
include_once __DIR__ . '/../src/config/init.php';
$conexao = connectBanco();
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php if(isAdmin()): ?>
<?php include __DIR__ . '/../public/navbar.php'; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Visualizar Usuário
                        <a href="../admin/gerenciamento.php" class="btn btn-danger float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
                        $sql = "SELECT * FROM user WHERE idUser='$usuario_id'";
                        $query = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($query) > 0) {
                            $usuario = mysqli_fetch_assoc($query);
                            ?>
                            <div class="mb-3"><label>Nome</label><p class="form-control"><?= $usuario['nome'] ?></p></div>
                            <div class="mb-3"><label>Email</label><p class="form-control"><?= $usuario['email'] ?></p></div>
                            <div class="mb-3"><label>CPF</label><p class="form-control"><?= $usuario['cpf'] ?></p></div>
                            <div class="mb-3"><label>CEP</label><p class="form-control"><?= $usuario['cep'] ?></p></div>
                            <div class="mb-3"><label>Rua</label><p class="form-control"><?= $usuario['rua'] ?></p></div>
                            <div class="mb-3"><label>Bairro</label><p class="form-control"><?= $usuario['bairro'] ?></p></div>
                            <div class="mb-3"><label>Cidade</label><p class="form-control"><?= $usuario['cidade'] ?></p></div>
                            <div class="mb-3"><label>Estado</label><p class="form-control"><?= $usuario['estado'] ?></p></div>
                            <div class="mb-3"><label>Tipo</label><p class="form-control"><?= $usuario['tipo'] ?></p></div>
                            <?php
                        } else {
                            echo "<h5 class='text-danger'>Usuário não encontrado.</h5>";
                        }
                    } else {
                        echo "<h5 class='text-danger'>ID não informado.</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<?php else: ?>
    <div class="container text-center mt-5">
        <h1 class="text-danger">Acesso Negado</h1>
        <p class="text-white">Você não tem permissão para acessar esta página.<p>
    </div>
<?php endif; ?>
</body>
</html>