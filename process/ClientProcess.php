<?php 
require('../inc/conexion.php');
require('../inc/funciones.php');
require('../clases/Client.php');

$clientes = new Client($pdo);

// Crear
if(isset($_POST['accion']) && $_POST['accion'] == 'agregar'){
    //print_pre($_POST);
    //print_pre($_FILES);
    $ruta = '../uploads/';
    $ext = pathinfo($_FILES['foto_cliente']['name'], PATHINFO_EXTENSION);
    $fichero_subido = $ruta.md5($_FILES['foto_cliente']['name'].time()).'.'.$ext;
    move_uploaded_file($_FILES['foto_cliente']['tmp_name'], $fichero_subido);
    
    $_POST['foto'] = $fichero_subido;
    if($clientes->create($_POST)){
        header('Location: ../paginas/listado_clientes.php?msg=successfully');
    }else{
        header("Location: ../paginas/listado_clientes.php?msg=error&errodb={$clientes->error}");
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'editar'){

    if($_FILES['foto_cliente']['error'] == 0){
        $ruta = '../uploads/';
        $ext = pathinfo($_FILES['foto_cliente']['name'], PATHINFO_EXTENSION);
        $fichero_subido = $ruta.md5($_FILES['foto_cliente']['name'].time()).'.'.$ext;
        move_uploaded_file($_FILES['foto_cliente']['tmp_name'], $fichero_subido);
        $_POST['foto'] = $fichero_subido;
    }else{
        $_POST['foto'] = $_POST['foto_cliente'];
    }
    //print_pre($_POST);
    //print_pre($_FILES);

    //exit();
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

