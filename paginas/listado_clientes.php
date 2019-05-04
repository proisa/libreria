<?php
require('../process/ClientProcess.php');

if($_SESSION['login'] !== true){
    header('Location: ../index.php');
}
require('../header.php');
?>
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
                        foreach ($clientes->list()['datos'] as $key => $value): ?>
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
                            <td><b>Total Registros <?=$clientes->list()['total_registros']?></b></td>
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
    <script src="../js/jquery.js"></script>
    <script src="../js/sweetalert.js"></script>
    <script>
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'error'): ?>
    
        Swal.fire({
            title: 'Error!',
            text: 'Operacion invalida',
            type: 'error',
            confirmButtonText: 'Cool'
        });
    
    <?php elseif(isset($_GET['msg']) && $_GET['msg'] == 'successfully'):?>
    Swal.fire({
            title: 'Listo!',
            text: 'Operacion completada exitosamente',
            type: 'success',
            confirmButtonText: 'Cool'
        });
    <?php endif;?>
    </script>
</body>
</html>