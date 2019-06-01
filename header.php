<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../js/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/morris.css"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker3.standalone.min.css"/>
    
    <title>
        <?= $titulo = isset($titulo) ? $titulo : 'Titulo' ?>
    </title>
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
                        <li>
                            <a class="nav-link" href="../process/AuthProcess.php?logout=true">Salir</a>
                        </li>
                    </ul>
            </div>
        </nav>
    </header>