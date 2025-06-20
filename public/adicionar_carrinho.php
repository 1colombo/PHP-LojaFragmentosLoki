<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$id = $_POST['id'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];

if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]['quantidade']++;
} else {
    $_SESSION['carrinho'][$id] = [
        'nome' => $nome,
        'preco' => $preco,
        'quantidade' => 1
    ];
}

header("Location: index.php");
exit();
