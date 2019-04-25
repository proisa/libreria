<?php
    require('../inc/datos.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Listado de libro</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Libreria</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="listado_libros.html">Listado de libros</a>
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
               <form action="listado_libros.php" class="margen_sup" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text" name="titulo" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el titulo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario">Autor</label>
                            <select name="autor" id="" class="form-control">
                                <?php foreach ($autores as $key => $value): ?>
                                    <option value="<?=$value['id']?>"><?=$value['nombre']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editora">Editora</label>
                                <input type="text" name="editora" maxlength="40" class="form-control" id="editora" placeholder="Escriba la editora">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Categoria">Categoria</label>
                                <select name="categoria" id="Categoria" class="form-control">
                                <?php foreach ($categorias as $key => $value): ?>
                                    <option value="<?=$value['id']?>"><?=$value['nombre']?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editora">Fecha</label>
                                    <input type="date" name="fecha" maxlength="40" class="form-control" id="editora" placeholder="Escriba la editora">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Categoria">Caratula</label>
                                    <input type="file" name="caratula">
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Numero de paginas</label>
                                <input class="form-control" type="number">     
                            </div>
                            <div class="col-md-12">
                                    <label for="">Observacion</label>
                                    <textarea class="form-control" name="" id="" cols="20" rows="5"></textarea>
                                </div>
                        </div>
                        <br>
                   <button type="submit" class="btn btn-success">
                        Guardar
                   </button>

               </form>
            </div>
            <div class="col-md-4">
                <div id="lateral">
                    <h2>Destacados</h2>
                    <ul>
                        <li>Historia Dominicana 1</li>
                        <li>Ciencias Sociales 3</li>
                        <li>Ingles 2</li>
                    </ul>
                </div>
            </div>
        </div>
       
    </div>
    </section>
    
</body>
</html>