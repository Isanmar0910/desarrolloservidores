<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    CONST PUNTOS_EXTRA = 1.0;

    $nota_corte = 5;

    $alumnos = [
        "Laura" => 8.5,
        "Pedro" => 4.0,
        "Marta" => 6.5,
        "Sergio" => 3.0,
        "Carlos" => 5.0,
        "Elena" => 0.2,
        "David" => 9.2,
        "Ana" => 7.0,
        "Pablo" => 4.8,
        "Lucía" => 10
    ];

    $aprobado = array_filter($alumnos, function ($value) use ($nota_corte) {
        return $value >= $nota_corte;
    });

    print_r($aprobado);

    $extra = array_map(fn($n) => $n + PUNTOS_EXTRA, $alumnos);

    echo "<br> Aprobados: ";

    print_r($extra);

    echo "<br> Extra: ";

    $suma = array_reduce($alumnos,function ($carry, $item) {
        return $carry += $item;
    });

    print_r($suma);

    echo "<br> Suma: ";

    

    ?>
</body>

</html>