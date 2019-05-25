<?php
require('../process/InvoiceProcess.php');

if($_SESSION['login'] !== true){
    header('Location: ../index.php');
}
require('../header.php');

//print_pre($invoice->list(1));

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
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
                        foreach ($invoice->list($pagina)['datos'] as $key => $value): ?>
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
                                <a href="editar_cliente.php?codigo=<?=$value['CL_CODIGO']?>" class="btn btn-info d-print-none" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i> </a>
                                <a href="resumen_grafica.php?codigo=<?=$value['CL_CODIGO']?>&type=line" class="btn btn-info d-print-none" data-toggle="tooltip" data-placement="top" title="Ver grafica"> <i class="fas fa-chart-line"></i></a>
                                <a href="../process/ClientProcess.php?codigo=<?=$value['CL_CODIGO']?>&accion=enviar_reporte" class="btn btn-info d-print-none" data-toggle="tooltip" data-placement="top" title="Enviar estado"><i class="far fa-envelope"></i></a>
                                <a href="../reportes/estado_cuenta.php?codigo=<?=$value['CL_CODIGO']?>" class="btn btn-info d-print-none" data-toggle="tooltip" data-placement="top" title="Estado de cuenta"><i class="far fa-file-alt"></i></a>
                                <a href="#" class="btn btn-danger eliminar d-print-none" onclick="eliminar('<?=$value['CL_CODIGO']?>');" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php 
                        $total += $value['CL_LIMCRE'];
                        endforeach; ?>
                    </tbody>
                
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php for($i=1;$i<=10;$i++):?>
                        <li class="page-item">
                            <a class="page-link" href="listado_facturas.php?pagina=<?=$i?>" tabindex="-1" aria-disabled="true"><?=$i?></a>
                        </li>
                        <?php endfor;?>
                    </ul>
                </nav>
            </div>
            </div>
        </div>
    </div>
    </section>