<?php
session_start();

require "funciones.php";


if (!empty($_POST) && empty($_SESSION)) {
    $_SESSION["nombre"] = $_POST["nombre"] ?? "";
    $_SESSION["noche"] = $_POST["noche"] ?? 0;
    $_SESSION["precio"] = $_POST["precio"] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <nav>
        <li><a href="jalojey.php">inicio</a></li>
        <li><a href="habitaciones.php">habitaciones</a></li>
        <li><a href="reservas.php">reservas</a></li>
        <li><a href="huespedes.php">huespedes</a></li>
        <li><a href="servicios.php">servicios</a></li>
    </nav>
</head>

<body>
    <h1>HOTEL TRANSILPAPU 67</h1>

    <?php


    ?>

    <div>
        <form action="jalojey.php" method="post">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre"><br>
            <label for="precio">Precio por noche</label>
            <input type="number" name="precio" id="precio" min="0"><br>
            <label for="noche">Nº de Noches</label>
            <input type="number" name="noche" id="noche" min="0"><br>
            <button>Calcular Importe</button>
        </form>
    </div>

    <?php if (!empty($_SESSION["nombre"])): ?>
        <div>
            <h3>Resultado de la estancia</h3><br><br>
            <p>Huesped:             <?= $_SESSION["nombre"] ?></p>
            <p>Precio por noche:    <?= $_SESSION["precio"] ?></p>
            <p>Noches:              <?= $_SESSION["noche"] ?></p>
            <h2>Importe total:       <?= calcularEstancia($_SESSION["precio"], $_SESSION["noche"]) ?>€</h2>
        </div>
    <?php endif; ?>

</body>

</html>