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
               <form enctype="multipart/form-data" action="../process/ClientProcess.php"  method="post" class="margen_sup">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="titulo">Codigo</label>
                            <input type="text" name="codigo"  maxlength="12" class="form-control" id="titulo" placeholder="Escriba el codigo">
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
                            <input type="phone" name="telefono" maxlength="13" class="form-control" id="telefono" placeholder="Escriba el telefono">
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
                            <input type="text" name="limite" maxlength="40" class="form-control" id="limite" placeholder="Escriba el limite">
                        </div>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <label for="">Nota</label>
                        <textarea class="form-control" name="detalle" id="" cols="25" rows="5"></textarea>
                        </div> 
                        <div class="col-md-6">
                            <div class="foto_container">
                                <img src="../img/sin_foto.png" alt="">
                            </div>
                            <input type="file" name="foto_cliente" id="foto_cliente">
                        </div> 
                    </div>
                   <hr>
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
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script>

function formatMoney(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };

        $("#telefono").mask('000-000-0000');
       
        $("#limite").change(function(){
            var valor = $(this).val();
            $("#limite").val(formatMoney(valor));
        });
        
        $('.foto_container').click(function(){
           $('#foto_cliente').click();
        });

        $('#foto_cliente').change( function(event) {
            $("img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
    </script>
    
</body>
</html>