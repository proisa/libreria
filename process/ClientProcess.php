<?php 
require('../inc/conexion.php');
require('../inc/funciones.php');
require('../clases/Client.php');

$clientes = new Client($pdo);
// Crear
if(isset($_POST['accion']) && $_POST['accion'] == 'agregar'){
    if($clientes->create($_POST)){
        header('Location: ../paginas/listado_clientes.php?msg=successfully');
    }else{
        header("Location: ../paginas/listado_clientes.php?msg=error&errodb={$clientes->error}");
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'editar'){
    if($clientes->edit($_POST)){
        header('Location: ../paginas/listado_clientes.php?msg=successfully');
    }else{
        header('Location: ../paginas/listado_clientes.php?msg=error');
    }
}

if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar'){
    if($clientes->delete($_GET['codigo'])){
        header('Location: ../paginas/listado_clientes.php?msg=successfully');
    }else{
        header('Location: ../paginas/listado_clientes.php?msg=error');
    }
  
}

