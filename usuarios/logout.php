<?php
include_once __DIR__ . '../src/config/conexao.php';
session_start();
session_unset();
session_destroy();
  header('Location: ../usuarios/login.php');
exit();