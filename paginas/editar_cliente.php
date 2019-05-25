<?php
    require('../process/ClientProcess.php');



    $datosCli = $clientes->getClient($_GET['codigo']);

    $query = $pdo->query("SELECT ZO_CODIGO,ZO_NOMBRE FROM CCBDZONA");
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Agregar Cliente</title>
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
            <div class="col-md-12">
               <form enctype="multipart/form-data" action="listado_clientes.php"  method="post" class="margen_sup">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Codigo</label>
                            <input type="text" name="codigo" required="true" maxlength="12" class="form-control" readonly="true" id="titulo"  value="<?=$datosCli['CL_CODIGO']?>" placeholder="Escriba el codigo">
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Nombre</label>
                            <input type="text" name="nombre" required="true" maxlength="40" class="form-control" id="nombre" placeholder="Escriba el nombre" value="<?=$datosCli['CL_NOMBRE']?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Direccion</label>
                            <input type="text" name="direccion" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el direccion" value="<?=$datosCli['CL_DIREC1']?>">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Telefono</label>
                            <input type="text" name="telefono" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el telefono" value="<?=$datosCli['CL_TELEF1']?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Zona</label>
                            <select name="zona" id="" class="form-control">
                                <?php foreach ($datos as $key => $value): ?>
                                    <option <?=selected($datosCli['ZO_CODIGO'],$value['ZO_CODIGO'])?> value="<?=$value['ZO_CODIGO']?>"><?=$value['ZO_NOMBRE']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Limite de credito</label>
                            <input type="text" name="limite" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el limite" value="<?=$datosCli['CL_LIMCRE']?>">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <label for="">Nota</label>
                        <textarea class="form-control" name="detalle" id="" cols="25" rows="5"><?=$datosCli['CL_DETALLE']?></textarea>
                        </div> 
                        <div class="col-md-6">
                            <div class="foto_container">
                                <?php if(!empty(trim($datosCli['CL_FOTO']))):?>
                                    <img src="<?=$datosCli['CL_FOTO']?>" alt="">
                                <?php else:?>
                                     <img src="../img/sin_foto.png" alt="">
                                <?php endif;?>
                            </div>
                            <input type="file" name="foto_cliente" id="foto_cliente">
                            <input type="hidden" name="foto_cliente" value="<?=$datosCli['CL_FOTO']?>">
                        </div> 
                    </div>
                   <hr>
                   <button type="submit" class="btn btn-success">
                        Guardar 
                   </button>

                  <a href="listado_clientes.php" class="btn btn-info">Regresar</a>

                   
                <input type="hidden" name="accion" value="editar">
               </form>
            </div>
        </div>
    </div>
    </section>

    <script src="../js/jquery.js"></script>
    <script>
        $('.foto_container').click(function(){
           $('#foto_cliente').click();
        });

        $('#foto_cliente').change( function(event) {
            $("img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
    </script>
    
</body>
</html>