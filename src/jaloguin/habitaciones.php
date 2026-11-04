<?php
require "funciones.php";

$mensaje = "";
$seleccionada = "";
if (!empty($_POST["nombre"])) {

    foreach ($habitaciones as $habitacion) {

        if ($habitacion["Numero"] == $_POST["habitacion"] && $habitacion["Estado"] == "Disponible") {
            $total = calcularEstancia($habitacion["Precio/Noche"], $_POST["noche"]);
            
            $seleccionada = $habitacion["Numero"] . " - " . $habitacion["Habitacion"];
            
            $mensaje = 
            "Habitación: " . $habitacion["Habitacion"] . " (nº " . $habitacion["Numero"] . ")<br>"
            . "Precio por noche: " . $habitacion["Precio/Noche"] 
            . " €<br>"
            . "Noches: " . $_POST["noche"] 
            . "<br>"
            . "<h2>Total de la estancia: " . $total . " €</h2>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0UuQsvaZ2eU6mnyPhB4WKrnUS9Rzpx7cwWjs4fYpLRIpPgMX4psCUm9sp&s=10");
            color: #fff;
        }
    </style>
    <nav>
        <li><a href="jalojey.php">inicio</a></li>
        <li><a href="habitaciones.php">habitaciones</a></li>
        <li><a href="reservas.php">reservas</a></li>
        <li><a href="huespedes.php">huespedes</a></li>
        <li><a href="servicios.php">servicios</a></li>
    </nav>

</head>

<body>
    <h1>Habitasustos del Papuhotel 😱</h1>
    <p>Selecciona una habitacion disponible para blablabla</p>

    <form action="habitaciones.php" method="post">
        <div>
            <h2>🦐 Habitaciones Disponibles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Precio / Noche</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php verHabitaciones($habitaciones); ?>
                </tbody>
            </table>
        </div>
        <div>
            <h2>🧦 Calcular esancia</h2>
            <p>HabitaSUsto selsccioyuyu</p>
            <?= $seleccionada ?>
            <br><label for="nombre">Nombre Guespeed</label><br>
            <input type="text" name="nombre" id="nombre"><br>
            <label for="noche">Numero de noches</label>
            <input type="number" name="noche" id="noche" min="1">
            <button>Calcular Importe</button>

            <?php if ($mensaje != ""): ?>
                <div>
                    <h3>Resultado de la estancia</h3>
                    <p><?= $mensaje ?></p>
                </div>
            <?php endif; ?>
        </div>
    </form>

</body>

</html>