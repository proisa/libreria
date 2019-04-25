<?php
require('../inc/conexion.php');
require('../inc/funciones.php');

if(isset($_POST['accion']) && $_POST['accion'] == 'agregar'){
    $insert = $pdo->prepare("INSERT INTO CCBDCLIE (CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE) VALUES (:codigo,:nombre,:direccion,:telefono,:zona,:limite)");

    $insert->bindValue(':codigo',$_POST['codigo']);
    $insert->bindValue(':nombre',$_POST['nombre']);
    $insert->bindValue(':direccion',$_POST['direccion']);
    $insert->bindValue(':telefono',$_POST['telefono']);
    $insert->bindValue(':zona',$_POST['zona']);
    $insert->bindValue(':limite',$_POST['limite']);

    $insert->execute();
}

if(isset($_POST['accion']) && $_POST['accion'] == 'editar'){
    $update = $pdo->prepare("UPDATE CCBDCLIE SET CL_NOMBRE = :nombre,CL_DIREC1 = :direccion,CL_TELEF1 = :telefono,ZO_CODIGO = :zona,CL_LIMCRE = :limite WHERE CL_CODIGO = :codigo");

    $update->bindValue(':nombre',$_POST['nombre']);
    $update->bindValue(':direccion',$_POST['direccion']);
    $update->bindValue(':telefono',$_POST['telefono']);
    $update->bindValue(':zona',$_POST['zona']);
    $update->bindValue(':limite',$_POST['limite']);
    $update->bindValue(':codigo',$_POST['codigo']);

    $update->execute();

}



$query = $pdo->query("SELECT TOP(10) CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE FROM CCBDCLIE ORDER BY CL_ID DESC ");
$datos = $query->fetchAll(PDO::FETCH_ASSOC);
$total_registros = $query->rowCount();

print_pre($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Listado de clientes</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Libreria</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Listado de libros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Autores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
            </div>
        </nav>
    </header>
    <section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="agregar_cliente.php" class="btn btn-success btn-add">Agregar nuevo</a>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Zona</th>
                        <th style="text-align:right;">Limite de Credito</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;                       
                        foreach ($datos as $key => $value): ?>
                        <?php 
                        $color = '#000';
                        if($value['CL_LIMCRE'] <= 200000){
                            $color = 'red';
                        } ?>
                        <tr style="color:<?=$color?>">
                            <td><?=$value['CL_CODIGO']?></td>
                            <td><?=$value['CL_NOMBRE']?></td>
                            <td><?=$value['ZO_CODIGO']?></td>
                            <td style="text-align:right;"><?=number_format($value['CL_LIMCRE'],2)?></td>
                            <td>
                                <a href="editar_cliente.php?codigo=<?=$value['CL_CODIGO']?>" class="btn btn-info">Editar</a>
                                <a href="listado_clientes.php?accion=eliminar&codigo=<?=$value['CL_CODIGO']?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                        <?php 
                        $total += $value['CL_LIMCRE'];
                        endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><b>Total Registros <?=$total_registros?></b></td>
                            <td><b>Total Limite de credito <?=number_format($total,2)?></b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>