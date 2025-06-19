<?php 
function isAdmin() {
    return isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'Admin';
}
function isUser() {
    return isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'User';
}
function isLoggedIn() {
    return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
}
?>