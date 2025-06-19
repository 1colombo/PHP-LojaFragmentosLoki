<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fragmentos de Loki</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
body {
    min-height: 100vh;
    display: flex;
    background-color:rgb(20, 19, 19);
}
</style>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                <?php include_once __DIR__ . '/../src/config/mensagem.php';?>
                    <form action="logar.php" method="POST">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Senha</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="login_btn" class="btn btn-primary" value="Entrar">
                        </div>
                    </form>
                    <div class="mb-3">
                        <a href="createUser.php" class="btn btn-secondary">Cadastrar</a>
                    </div>
                </div>
            </div>
    </div>
</div>
</body>