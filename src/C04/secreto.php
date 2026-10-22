<?php


function generacion(int $puerta = 1): void
{
    switch ($puerta) {
        case 1:
            $min = 100;
            $max = 999;
            $intentos = 10;
            break;
        case 2:
            $min = 1000;
            $max = 9999;
            $intentos = 6;
            break;
        case 3:
            $min = 10000;
            $max = 99999;
            $intentos = 4;
            break;
    }

    $_SESSION["codigo"] = random_int($min,$max);
    $_SESSION["min"] = $min;
    $_SESSION["max"] = $max;
    $_SESSION["maxIntent"] = $intentos;
    $_SESSION["intentos"] = 0;
}

function comprobacion(string $codigo = "", int $min = 100, int $max = 999): ?bool
{
    $resultado = false;

    if ($codigo === "") {
        $resultado = null;
    } elseif ($codigo >= $min && $codigo <= $max) {
        $resultado = true;
    }

    return $resultado;
}

function pistas(): string
{
    global $mensajeIntento;

    if (empty($_POST["codigo"])) {
        return "";
    }

    if ($_POST["codigo"] > $_SESSION["codigo"]) {
        $mensajeIntento = "El numero es menor";
    } elseif ($_POST["codigo"] < $_SESSION["codigo"]) {
        $mensajeIntento = "El numero es mayor";
    }

    return $mensajeIntento;
}