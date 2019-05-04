<?php
    require('../inc/conexion.php');
    $query = $pdo->query("SELECT ZO_CODIGO,ZO_NOMBRE FROM CCBDZONA");
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    require('../header.php');
?>

    <section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <form action="../process/ClientProcess.php"  method="post" class="margen_sup">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Codigo</label>
                            <input type="text" name="codigo" required="true" maxlength="12" class="form-control" id="titulo" placeholder="Escriba el codigo">
                        </div>
                    </div>    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Nombre</label>
                            <input type="text" name="nombre" required="true" maxlength="40" class="form-control" id="nombre" placeholder="Escriba el nombre">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Direccion</label>
                            <input type="text" name="direccion" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el direccion">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Telefono</label>
                            <input type="text" name="telefono" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el telefono">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Zona</label>
                            <select name="zona" id="" class="form-control">
                                <?php foreach ($datos as $key => $value): ?>
                                    <option value="<?=$value['ZO_CODIGO']?>"><?=$value['ZO_NOMBRE']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Limite de credito</label>
                            <input type="text" name="limite" maxlength="40" class="form-control" id="titulo" placeholder="Escriba el limite">
                        </div>
                    </div>
                    </div>
                   
                   <button type="submit" class="btn btn-success">
                        Guardar 
                   </button>

                  <a href="listado_clientes.php" class="btn btn-info">Regresar</a>

                   
                <input type="hidden" name="accion" value="agregar">
               </form>
            </div>
        </div>
    </div>
    </section>
    
</body>
</html>