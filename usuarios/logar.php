<?php
session_start();
include_once __DIR__ . '/../src/config/init.php';

$conn = connectBanco();

$email = trim($_POST['email'] ?? '');
$senha = $_POST['password'] ?? '';

if (empty($email) || empty($senha)) {
    $_SESSION['mensagem'] = "Preencha todos os campos.";
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT idUser, nome, senha, tipo FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($usuario = $resultado->fetch_assoc()) {
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['idUser'] = $usuario['idUser'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipo'] = $usuario['tipo'];
        $_SESSION['logado'] = true;

        if (isAdmin()) {
            header("Location: ../admin/gerenciamento.php");
        } else {
            header("Location: ../public/index.php");
        }
        exit();
    } else {
        $_SESSION['mensagem'] = "Senha incorreta.";
    }
} else {
    $_SESSION['mensagem'] = "Usuário não encontrado.";
}

header("Location: login.php");
exit();