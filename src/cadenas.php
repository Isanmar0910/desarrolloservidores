<?php


    #ARRAy
    $a = [0,1,2,3];

    $a[] = 5;

    $a[6] = 7;

    echo "hola";
    echo "<br>";
    print_r($a);
    echo "<br>";
    
    $resultado = is_array($a);

    var_dump($resultado);

    unset($a[3]);

    print_r($a);

    $b = ["a" => 1, "d" => 5];
    $c = ["a" => 2, 3, 6];
    $d = ["c" => 4, ...$b];
    
    echo"<br>";
    print_r($d);
?>