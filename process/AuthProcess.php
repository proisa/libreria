<?php 
require('../inc/conexion.php');
require('../inc/funciones.php');
require('../clases/Auth.php');

$auth = new Auth($pdo);
// Login 
if($auth->login($_POST['usuario'],$_POST['clave'])){
    header('Location: ../paginas/listado_clientes.php');
}else{
    header('Location: ../index.php?auth=failed');
}


// Logout
if(isset($_GET['logout']) && $_GET['logout'] == true){
    $auth->logOut();
    header('Location: ../index.php');
}

