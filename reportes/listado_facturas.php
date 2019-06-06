<?php
require('../process/InvoiceProcess.php');

if($_SESSION['login'] !== true){
    header('Location: ../index.php');
}


$desde = isset($_GET['desde']) ? $_GET['desde'] : date('d/m/Y');
$hasta = isset($_GET['hasta']) ? $_GET['hasta'] : date('d/m/Y');

$datos = $invoice->reporte($desde,$hasta);

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
                <form action="listado_facturas.php" method="GET">
                <div class="row">
                        <!-- Form -->
                        <div class="col-md-2">
                        <label for="">Desde</label>
                            <div class="input-group">
                                <input type="text" name="desde"  class="form-control date" value="<?=$desde?>">
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
                                <input type="text" name="hasta" class="form-control date" value="<?=$hasta?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-info" style="margin-top:32px;"> Filtrar <i class="fas fa-search"></i></button>
                        </div>
                        <!-- End form -->
                    </div>
                </form>
                <h4 id="titulo">Estado de cuenta de</h4>
                <div class="table-responsive p-3">
                <div class="blue-line"></div>    
                <table class="table" id="myTable">
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
                      // $b_acumulado = 0;
                      // foreach($clientes->estado($_GET['codigo']) as $data):  ?>
                    <tr>
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
                    </tr>
                        <?php//  endforeach; ?>
                    </tbody>
                </table>
              
            </div>
            </div>
        </div>
    </div>
    </section>

    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/datepicker.min.js"></script>

    <script>
     $('.date').datepicker({
            format: 'dd/mm/yyyy',
        });
    </script>