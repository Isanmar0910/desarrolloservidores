<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    $intento = $_POST["posicion"]??"Asigna un valor";
    $diamante = $_POST["diamante"];
    $ver = "";

    if ($intento == $diamante) {
        echo "Enhorabuena has acertado la posicion del diamante W aura 67";
        $ver = "none";
    }elseif (empty($intento)) {
        echo "tienes que asignar un valor";
    }else {
        echo "Illo espabila que has fallao";

        
    }
    
    
?> 
    <br>
    <a href="tesoro.php" style="display: <?php echo $ver;?>">Intentalo otra ve maquina</a>
    
</body>
</html>
