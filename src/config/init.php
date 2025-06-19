<?php 
session_start();
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../config/auth.php';

$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);
?>