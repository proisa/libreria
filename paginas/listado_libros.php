<?php
ini_set('display_errors',1);
include('../inc/funciones.php');

$datos = [
    ['id'=>1,'titulo'=>'Historia Dominicana 1','autor'=>'Pedro','categoria'=>'Historia'],
    ['id'=>1,'titulo'=>'Historia Dominicana 5','autor'=>'Mauricio','categoria'=>'Historia'],
    ['id'=>1,'titulo'=>'Historia Dominicana 8','autor'=>'Juan','categoria'=>'Historia'],
    ['id'=>1,'titulo'=>'Historia Dominicana 8','autor'=>'Juan','categoria'=>'Historia'],
];

$datos[] = ['id'=>1,'titulo'=>'Historia Dominicana 9','autor'=>'Maria','categoria'=>'Historia'];


//print_pre($datos);

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
    <title>Listado de libro</title>
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
            <div class="col-md-8">
                <a href="agregar_libro.html" class="btn btn-success btn-add">Agregar nuevo</a>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>Accion</th>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $key => $value): ?>
                        <tr>
                            <td><?=$value['id']?></td>
                            <td><?=$value['titulo']?></td>
                            <td><?=$value['autor']?></td>
                            <td><?=$value['categoria']?></td>
                            <td>
                                <a href="ver.html" class="btn btn-primary btn-sm"><i class="fas fa-eye "></i></a>    
                                <a href="#" class="btn btn-primary btn-sm">Editar </a>    
                                <a href="#" class="btn btn-danger btn-sm"> <i class="fas fa-trash "></i>  </a>    
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="col-md-4">
                <div id="lateral">
                    <h2>Destacados</h2>
                    <ul>
                    <?php foreach ($datos as $key => $value): ?>
                        <li><?=$value['categoria']?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>