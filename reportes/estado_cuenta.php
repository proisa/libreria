<?php
require('../process/ClientProcess.php');

if($_SESSION['login'] !== true){
    header('Location: ../index.php');
}

$cliente_data = $clientes->getClient($_GET['codigo']);
require('../header.php');

?>

<style>

#codigo {
    display:none;
}

@media print {
    #titulo {
        font-size:20px;
        color:red;
    }

    #codigo {
        display: inline;
    }

    table {
        font-size: 10px;
    }
}

</style>
    <section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 box_container">
                <h4 id="titulo">Estado de cuenta de <?=$cliente_data['CL_NOMBRE']?> <span id="codigo"> - <?=$cliente_data['CL_CODIGO']?></span></h4>
                <div class="table-responsive p-3">
                <div class="blue-line"></div>    
                <table class="table" id="myTable">
                    <thead>
                    <th>Fecha</th>
                    <th >Factura ID</th>
                    <th >NCF</th>
                    <th class="text-right">Dias</th>
                    <th class="text-right">Monto Factura</th>
                    <th class="text-right">Balance</th>
                    <th class="text-right">Balance acumulado</th>
                    </thead>
                    <tbody>
                        <?php 
                       $b_acumulado = 0;
                       foreach($clientes->estado($_GET['codigo']) as $data):  ?>
                    <tr>
                        <td style="width:120px;"><?=dateFormat($data['HI_FECHA'])?></td>
                        <td ><?=trim($data['HI_DOCUM'])?></td>
                        <td ><?=trim($data['HI_NCF'])?></td>
                        <td class="text-right"><?=number_format($data['DIAS'],0)?></td>
                        <td class="text-right"><?=number_format($data['HI_MONTO'],2)?></td>
                        <td class="text-right"><?=number_format($data['HI_BFACTURA'],2)?></td>
                        <td class="text-right"><?=number_format($b_acumulado += $data['HI_BFACTURA'],2) ?></td>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><b>Balance Total: <?=number_format($b_acumulado,2);?></b></p>
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
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/datatables.min.js"></script>
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

    function formatMoney(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };

    $(document).ready( function () {
    $('#myTables').DataTable({
       "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningun dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ãšltimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
            "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "lengthChange": true,
        "pageLength": 25,
        "dom": '<"top"Bfrtip<"clear">>rt<"bottom"ilp<"clear">>',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });


    /**
     * 
     *  "lengthChange": false,
        "pageLength": 25,
        "dom": '<"top"Bfrtip<"clear">>rt<"bottom"ilp<"clear">>',
        "buttons": [
            'excel', 'pdf',
        ]
     */

     
    </script>
</body>
</html>