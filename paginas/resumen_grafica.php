<?php
require('../process/ClientProcess.php');

if($_SESSION['login'] !== true){
    header('Location: ../index.php');
}
require('../header.php');

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;


   
?>

<section>
    <div class="container">
        <div class="box_container">
            <div class="row">
                <div class="col-md-12">
                   
                    <h2>Grafica de ventas por año de <?=$clientes->getClient($codigo)['CL_NOMBRE'];?></h2>
                    
                    <?php if($clientes->grafica($codigo)):?>
                    <div id="grafico" style="height:250px;">
                    </div>
                    <?php else:?>
                        <h2>No hay datos</h2>
                    <?php endif;?>
                    <div class="row">

                        <div class="col-md-2">
                            <a href="listado_clientes.php" class="btn btn-info ">Regresar</a>
                        </div>

                        <div class="col-md-4">
                        <label for="" class="text-primary">Tipo de grafico</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="line" id="line" value="option1">
                                <label class="form-check-label" for="line">Lineal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bar" id="bar" value="option2">
                                <label class="form-check-label" for="bar">Barra</label>
                            </div>
                        </div>
                    </div>
                   
                </div>
                
            </div>
        </div>
    </div>
</section>
    <script src="../js/jquery.js"></script>
    <script src="../js/raphael-min.js"></script>
    <script src="../js/morris.min.js"></script>
    <script>

var datos = <?=json_encode($clientes->grafica($codigo));?>

<?php if($_GET['type'] == 'bar'): ?>
    Morris.Bar({
    element: 'grafico',
    data: datos,
    xkey: 'Anio',
    ykeys: ['Monto_Ventas'],
    labels: ['Ventas']
    }).on('click', function(i, row){
    console.log(i, row);
    });

    $('#bar').attr('checked','checked');

<?php else:?>
    Morris.Line({
    element: 'grafico',
    data: datos,
    xkey: 'Anio',
    ykeys: ['Monto_Ventas'],
    labels: ['Ventas']
    }).on('click', function(i, row){
    console.log(i, row);
    });

    $('#line').attr('checked','checked');
<?php endif;?>




$('#line').click(function(){
   window.location.href = 'resumen_grafica.php?codigo=<?=$codigo;?>&type=line';
});

$('#bar').click(function(){
   window.location.href = 'resumen_grafica.php?codigo=<?=$codigo;?>&type=bar';
});


    /*
    new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'grafico',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
*/
    </script>

    </body>
</html>