<?php
require('../process/InvoiceProcess.php');

if($_SESSION['login'] !== true){
    header('Location: ../index.php');
}

$titulo = 'Listado de facturas';
require('../header.php');

//print_pre($invoice->list(1));

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$desde = isset($_GET['desde']) ? $_GET['desde'] : date('d/m/Y');
$hasta = isset($_GET['hasta']) ? $_GET['hasta'] : date('d/m/Y');

$datos = $invoice->list($pagina,$desde,$hasta);

$muestra_actual = $datos['muestra']*$pagina;

if($pagina >= $datos['total_paginas']){
    $muestra_actual = $datos['total_registros'];
}

$filtro = '';

if(isset($_GET['desde']) && isset($_GET['hasta'])){
    $filtro = '&desde='.$_GET['desde'].'&hasta='.$_GET['hasta'];
}

?>

<style>
   @media print {
       .total { 
           display: inherit;
       }

       .total > .wc {
           color:#ffffff;
       }
   }
</style>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
             
            </div>
            <div class="col-md-12">
                <div class="table-responsive bg-w p-3">
                    <div class="row">
                        <!-- Form -->
                        <div class="col-md-2">
                        <label for="">Desde</label>
                            <div class="input-group">
                                <input type="text" id="desde" class="form-control date" value="<?=$desde?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">Hasta</label>
                            <div class="input-group">
                                <input type="text" id="hasta" class="form-control date" value="<?=$hasta?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <a href="#" onclick="filtro()" class="btn btn-info" style="margin-top:32px;"> Filtrar <i class="fas fa-search"></i></a>
                        </div>
                        <!-- End form -->
                    </div>
               <hr>
                <table class="table" id="invoices">
                    <thead>
                        <th>Fecha</th>
                        <th>No. Factura</th>
                        <th>Cliente</th>
                        <th>RNC</th>
                        <th>Monto bruto</th>
                        <th>Descuento</th>
                        <th>Sub Total</th>
                        <th>Itbis</th>
                        <th>% Ley</th>
                        <th>Monto Neto</th>
                    </thead>
                    <tbody>
                        <?php                  
                        $total = 0;
                        foreach ($datos['datos'] as $key => $value): ?>
                        <tr style="color:<?=$color?>">
                            <td><?=$value['FECHA']?></td>
                            <td><?=$value['NRO_FACTURA']?></td>
                            <td><?=$value['CLIENTE']?>/<?=$value['NOMBRE']?></td>
                            <td><?=$value['RNC']?></td>
                            <td style="text-align:right;"><?=number_format($value['MONTO_BRUTO'],2)?></td>
                            <td style="text-align:right;"><?=number_format($value['DESCUENTO'],2)?></td>
                            <td style="text-align:right;"><?=number_format($value['SUB_TOTAL'],2)?></td>
                            <td style="text-align:right;"><?=number_format($value['ITBIS'],2)?></td>
                            <td style="text-align:right;"><?=number_format($value['PORCIENTO_DE_LEY'],2)?></td>
                            <td style="text-align:right;"><?=number_format($value['VALOR_NETO'],2)?></td>
                        </tr>
                        <?php 
                        $total += $value['VALOR_NETO'];
                        endforeach; ?>
                        <tr class='total' style="display:none">
                            <td style='color:#ffffff;' class="wc">ZZZZZZ</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total: <?=$total?></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                Mostrando <?=number_format($muestra_actual)?> de <?=number_format($datos['total_registros'],0)?>
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php if($pagina > 1): ?>    
                        <li class="page-item">
                            <a class="page-link" href="listado_facturas.php?pagina=<?=$pagina-1?><?=$filtro?>" tabindex="-1">Mostrar menos</a>
                        </li>
                        <?php endif;?>
                        <?php if($pagina < $datos['total_paginas']): ?>    
                            <li class="page-item">
                                <a class="page-link" href="listado_facturas.php?pagina=<?=$pagina+1?><?=$filtro?>" tabindex="1" >Mostrar mas</a>
                            </li>
                        <?php endif;?>
                    </ul>
                </nav>
            </div>
            </div>
        </div>
    </div>
    </section>

    <script src="../js/jquery.js"></script>
    <script src="../js/sweetalert.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/datatables.min.js"></script>
    <script type="text/javascript" src="../js/datepicker.min.js"></script>

    <script>
    $(document).ready( function () {

        function formatMoney(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };    

    $('#invoices').DataTable({
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
               'excel', 'pdf', 
                { 
                    extend: 'print',
                    title: '<h2>Proisa</h2>\
                    <p>Av. Estrella Sadhala, Plaza Milton, mod. 101 | 809-581-9644</p><hr>\
                    <h3 class="text-center">Listado de facturas</h3>',
                    message: '<p class="text-center">Desde: <?=$desde?> -  Hasta: <?=$hasta?></p>',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '16px' )
                            .prepend(
                                ''
                            );
    
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    },
                    footer: true 
                }
            ],
            // "footerCallback": function ( row, data, start, end, display ) {
            //     var api = this.api(), data;
    
            //     // Remove the formatting to get integer data for summation
            //     var intVal = function ( i ) {
            //         return typeof i === 'string' ?
            //             i.replace(/[\$,]/g, '')*1 :
            //             typeof i === 'number' ?
            //                 i : 0;
            //     };
    
            //     // Total over all pages
            //     total = api
            //         .column( 3 )
            //         .data()
            //         .reduce( function (a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0 );
    
            //     // Total over this page
            //     pageTotal = api
            //         .column( 3, { page: 'current'} )
            //         .data()
            //         .reduce( function (a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0 );
    
            //     // Update footer
            //     $( api.column( 3 ).footer() ).html(
            //         'Total pagina '+formatMoney(pageTotal) +' ('+ formatMoney(total) +' Total general)'
            //     );
            // }
        });


        $('.date').datepicker({
            format: 'dd/mm/yyyy',
        });
    });

    function filtro(){
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        window.location = window.location.pathname+'?pagina=<?=$pagina?>'+'&desde='+desde+'&hasta='+hasta;
    }


    </script>

    </body>
</html>