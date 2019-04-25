<?php

$titulo = 'Sin titulo';

if(isset($_GET['titulo'])){
    $titulo = $_GET['titulo'];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Login | Libreria</title>
    <style>
        .form-control-custom {
            border:none;
        }

        .form-control-custom:focus {
            border:none;
        }



        .input_custom {
            border: 2px solid grey;
            padding:10px;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="box">
                    <h1 class="text-center">
                        <?=$titulo?>
                    </h1>
                    <form action="paginas/listado_libros.php" method="post">
                        <div class="form-group">
                            <!-- <label for="usuario">Usuario</label> -->
                            <div class="input_custom">
                            <i class="fa fa-user"></i>    
                            <input type="text" name="usuario" maxlength="15" class="form-control-custom" id="usuario" placeholder="Escriba su usuario">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave</label>
                            <input type="password" name="clave" maxlength="20" class="form-control" id="clave" placeholder="Escriba su calve aqui">
                        </div>
                        <button type="submit" id="entrar" class="btn btn-success btn-block">Entrar</button>
                    </form>
                    <a href="paginas/registro.html">Registrarme</a> | <a href="paginas/recuperar_clave.html">Olvide mi clave</a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/sweetalert.js"></script>
    <script>

        // $("#entrar").click(function(){
        //     Swal.fire({
        //     title: 'Listo!',
        //     text: 'Has dado click',
        //     type: 'success',
        //     confirmButtonText: 'Cool'
        // })
        // });

       


    </script>
</body>
</html>