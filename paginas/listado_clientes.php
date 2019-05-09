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
                <div class="table-responsive bg-w p-3">
                <div class="blue-line"></div>    
                <table class="table" id="myTable">
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
                    <!-- <tfoot>
                        <tr>
                            <td><b>Total Registros <?=$clientes->list()['total_registros']?></b></td>
                            <td><b>Total Limite de credito <?=number_format($total,2)?></b></td>
                        </tr>
                    </tfoot> -->
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right">Total:</th>
                            <th></th>
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
    $('#myTable').DataTable({
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
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                'Total pagina '+formatMoney(pageTotal) +' ('+ formatMoney(total) +' Total general)'
            );
        }
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