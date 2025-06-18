<?php 
//Conectando ao banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$nome_banco = 'loja_loki';

$conexao = mysqli_connect($host, $usuario, $senha, $nome_banco);

if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}  
?>