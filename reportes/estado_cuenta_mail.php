<?php 
include '../process/ClientProcess.php';


//print_pre($clientes->estado($_GET['codigo']));
$cliente_data = $clientes->getClient($_GET['codigo']);

//print_pre($_SERVER);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Estado de cuenta</title>
    <style>
      .number_align {
            text-align:right;
        }

    </style>
</head>
<body>
    <h2 class="text-center">Estado de cuenta</h2>
    <hr>
    <p><b>Cliente: <?=$cliente_data['CL_NOMBRE'];?></b></p>
    <hr>
    <table class="table">
            <tr>
                <td>Fecha</td>
                <td >Factura ID</td>
                <td >NCF</td>
                <td class="number_align">Dias</td>
                <td class="number_align">Monto Factura</td>
                <td class="number_align">Balance</td>
                <td class="number_align">Balance acumulado</td>
            </tr>
            <?php 
            $b_acumulado = 0;
            foreach($clientes->estado($_GET['codigo']) as $data): 
            ?>
                <tr>
                    <td style="width:120px;"><?=dateFormat($data['HI_FECHA'])?></td>
                    <td ><?=trim($data['HI_DOCUM'])?></td>
                    <td ><?=trim($data['HI_NCF'])?></td>
                    <td class="number_align"><?=number_format($data['DIAS'],0)?></td>
                    <td class="number_align"><?=number_format($data['HI_MONTO'],2)?></td>
                    <td class="number_align"><?=number_format($data['HI_BFACTURA'],2)?></td>
                    <td class="number_align"><?=number_format($b_acumulado += $data['HI_BFACTURA'],2) ?></td>
                </tr>
            <?php endforeach;?>
    </table>
    <hr>
    <p><b>Balance Total: <?=number_format($b_acumulado,2);?></b></p>
</body>
</html>