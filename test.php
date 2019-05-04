<?php 
require('inc/conexion.php');
require('inc/funciones.php');
require('clases/Auth.php');

$auth = new Auth($pdo);

// echo $auth->login('JUAN','123');
// echo $auth->success;
// echo $auth->error;

// echo $_SESSION['nivel'];

$auth->logOut();

echo 'TEST';
echo '<br>';

