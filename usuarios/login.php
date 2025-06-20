<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fragmentos de Loki</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
</head>
<style>

</style>
<body>
    <div class="chuva"></div>
    <div class="container mt-5" id="login-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="login-card">
                    <div class="card-header">
                        <h4>Bem Vindo, Variante!</h4>
                    </div>
                    <div class="card-body">
                        <?php include_once __DIR__ . '/../src/config/mensagem.php';?>
                        <form action="logar.php" method="POST">
                            <div class="mb-3">
                                <input type="text" name="email" class="form-control" required placeholder="Email AVT">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" required placeholder="Senha Temporal">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="login_btn" class="btn btn-primary" id="btn-form" value="Entrar">
                            </div>
                            <div class="mb-3">

                            </div>
                            <div class="mb-3">
                                <p class="text-center">Ainda não é uma Variante?</p>
                            </div>
                            <div class="mb-3">
                                <a href="createUser.php" class="btn btn-secondary" id="btn-form">Cadastre-se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="../assets/js/script.js"></script>
</html>
