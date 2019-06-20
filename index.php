<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mantenimiento tienda</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
        <?php
        //A donde quiere ir el usuario: el enrutamiento
        $seccion = filter_input(INPUT_GET, "seccion");
        $accion = filter_input(INPUT_GET, "accion");
      
       
        if (empty($seccion)) {
            require_once 'vista/home.php';
        } else {
            if (file_exists("controlador/$seccion.php")) { // $seccion="categorias" o "productos".
                require_once "controlador/$seccion.php";
                $controller=new $seccion(); // Ejemplo: $controller=new "productos".
                $controller->$accion();     // Ejemplo: $controller="borrar".
            }
        }
        ?>
            </div>
    </body>
</html>