<?php
    require('../inc/conexion.php');
    require('../inc/funciones.php');

    $queryCli = $pdo->prepare("SELECT  CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE FROM CCBDCLIE WHERE CL_CODIGO = :codigo");
    $queryCli->bindValue(':codigo',$_GET['codigo']);
    $queryCli->execute();
    $datosCli = $queryCli->fetch(PDO::FETCH_ASSOC);

    print_pre($datosCli);

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
               <form action="listado_clientes.php"  method="post" class="margen_sup">
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
    
</body>
</html>