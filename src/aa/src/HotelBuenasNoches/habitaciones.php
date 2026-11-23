<?php
require_once "clases/Habitacion.php";
require_once "clases/Huesped.php";
require_once "clases/Reserva.php";
session_start();

if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [
        1 => new Habitacion(1, "Ataúd Real", 150.0, 2),
        2 => new Habitacion(2, "Torre del Murciélago", 110.0, 3),
        3 => new Habitacion(3, "Cripta Familiar", 90.0, 4),
        4 => new Habitacion(4, "Mazmorra Rústica", 60.0, 1),
        5 => new Habitacion(5, "Suite Luna Llena", 200.0, 2),
    ];
    $_SESSION["huespedes"] = [];
    $_SESSION["reservas"] = [];
    $_SESSION["contador"] = 0;
    $_SESSION["idReserva"] = 0;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Habitaciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <header>
        <h1>☆*: .｡. o(≧▽≦)o .｡.:*☆ Hotel Pachuru Buenas noches (●'◡'●)</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="habitaciones.php">Habitaciones</a>
            <a href="huespedes.php">Huéspedes</a>
            <a href="reservas.php">Reservas</a>
        </nav>
    </header>

    <main>
        <h2>Habitaciones</h2>
        <?php
        foreach ($_SESSION["habitaciones"] as $habitacion) {
            echo $habitacion->tarjetaHabitacion();
        }
        ?>
    </main>
</body>

</html>