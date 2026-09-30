<?php

    $intento = $_POST["posicion"]??"Asigna un valor";
    $diamante = $_POST["diamante"];

    if ($intento == $diamante) {
        echo "Enhorabuena has acertado la posicion del diamante W aura 67";
    }elseif (empty($intento)) {
        echo "tienes que asignar un valor";
    }else {
        echo "Illo espabila que has fallao";
    }
    
    
    