<?php
require('../inc/conexion.php');
require('../inc/funciones.php');

require_once '../inc/dompdf/lib/html5lib/Parser.php';
require_once '../inc/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once '../inc/dompdf/lib/php-svg-lib/src/autoload.php';
require_once '../inc/dompdf/lib/php-svg-lib/src/autoload.php';
require_once '../inc/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

// reference the Dompdf namespace
use Dompdf\Dompdf;


if(isset($_POST['accion']) && $_POST['accion'] == 'agregar'){
    try {
        $pdo->beginTransaction();
        $insert = $pdo->prepare("INSERT INTO CCBDCLIE (CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE,COD_SUCU) VALUES (:codigo,:nombre,:direccion,:telefono,:zona,:limite,1)");
        $insert->bindValue(':codigo',$_POST['codigo']);
        $insert->bindValue(':nombre',$_POST['nombre']);
        $insert->bindValue(':direccion',$_POST['direccion']);
        $insert->bindValue(':telefono',$_POST['telefono']);
        $insert->bindValue(':zona',$_POST['zona']);
        $insert->bindValue(':limite',$_POST['limite']);
    
        $insert->execute();
        $pdo->commit();
        
    }catch(Exception $e){
        //An exception has occured, which means that one of our database queries
        //failed.
        //Print out the error message.
        echo $e->getMessage();
        //Rollback the transaction.
    
        if($pdo->inTransaction()){
            $pdo->rollBack();
        }
    }
   
}

if(isset($_POST['accion']) && $_POST['accion'] == 'editar'){
    $pdo->beginTransaction();
    $update = $pdo->prepare("UPDATE CCBDCLIE SET CL_NOMBRE = :nombre,CL_DIREC1 = :direccion,CL_TELEF1 = :telefono,ZO_CODIGO = :zona,CL_LIMCRE = :limite WHERE CL_CODIGO = :codigo AND COD_EMPR = 1 AND COD_SUCU = 99345");
    $update->bindValue(':nombre',$_POST['nombre']);
    $update->bindValue(':direccion',$_POST['direccion']);
    $update->bindValue(':telefono',$_POST['telefono']);
    $update->bindValue(':zona',$_POST['zona']);
    $update->bindValue(':limite',$_POST['limite']);
    $update->bindValue(':codigo',$_POST['codigo']);
    $update->execute();

    if($update->rowCount() > 0){
        $pdo->commit();
    }else{
        $pdo->rollBack();
    }
}

if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar'){
    $update = $pdo->prepare("UPDATE CCBDCLIE SET CL_ACTIVO = 'D' WHERE CL_CODIGO = :codigo");
    $update->bindValue(':codigo',$_GET['codigo']);
    $update->execute();
    header('Location: listado_clientes.php');
}




$query = $pdo->query("SELECT TOP(20) CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE FROM CCBDCLIE WHERE CL_ACTIVO <> 'D' AND COD_EMPR = 1 AND COD_SUCU = 1 ORDER BY CL_ID DESC ");
$datos = $query->fetchAll(PDO::FETCH_ASSOC);
$total_registros = $query->rowCount();


// instantiate and use the dompdf class
$dompdf = new Dompdf();

$content = file_get_contents('http://localhost/libreria/index.php');

$dompdf->loadHtml($content);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
//$dompdf->render();
// Output the generated PDF to Browser
//$dompdf->stream();

//print_pre($_POST);

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
                                <a href="editar_cliente.php?codigo=<?=$value['CL_CODIGO']?>" class="btn btn-info d-print-none">Editar</a>
                                <a href="#" class="btn btn-danger eliminar d-print-none" onclick="eliminar('<?=$value['CL_CODIGO']?>');">Eliminar</a>
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
    <script>
        function eliminar(id){
            var resp = confirm("Esta seguro de eliminar este cliente?");
            if(resp == true){
                window.location = 'listado_clientes.php?accion=eliminar&codigo='+id;
            }
        }
    </script>
</body>
</html>