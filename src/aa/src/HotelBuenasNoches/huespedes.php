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
    $_SESSION["idReserva"] = 0;
}


$mensaje = "";
$error = "";

if (isset($_POST["registrar"])) {
    $nombrePila = $_POST["nombrePila"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $id = $_POST["id"];

    if ($nombrePila == "" || $apellidos == "" || $id == "") {
        $error = "Rellena todos los campos";
    } elseif (strlen($telefono) != 9) {
        $error = "El teléfono debe tener 9 números";
    } elseif (!str_contains($email, "@")) {
        $error = "El email no es válido";
    } else {
        $numero = count($_SESSION["huespedes"]) + 1;
        $huesped = new Huesped($numero, $nombrePila, $apellidos, (int)$telefono, $email, $id);
        $_SESSION["huespedes"][$numero] = $huesped;
        $mensaje = "Huésped registrado correctamente";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Huéspedes</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <header>
        <h1>☆*: .｡. o(≧▽≦)o .｡.:*☆ Hotel Pachuru Buenas noches (●'◡'●)</h1>
        <p class="sahur">67 TIKI TIKI PHONK SIGMA 🗿</p>
        <nav>
            <a href="habitaciones.php">Habitaciones</a>
            <a href="huespedes.php">Huéspedes</a>
            <a href="reservas.php">Reservas</a>
        </nav>
    </header>

    <main>
        <?php
        if ($mensaje != "") {
            echo "<p class='ok'>$mensaje</p>";
        }
        if ($error != "") {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <h2>Registrar huésped</h2>
        <form method="post" action="huespedes.php">
            <label>Nombre:</label>
            <input type="text" name="nombrePila">

            <label>Apellidos:</label>
            <input type="text" name="apellidos">

            <label>Teléfono:</label>
            <input type="text" name="telefono">

            <label>Email:</label>
            <input type="text" name="email">

            <label>Tipo de monstruo:</label>
            <input type="text" name="id">

            <button type="submit" name="registrar">Registrar</button>
        </form>

        <h2>Huéspedes registrados</h2>
        <?php
        if (count($_SESSION["huespedes"]) == 0) {
            echo "<p>Todavía no hay huéspedes.</p>";
        }
        foreach ($_SESSION["huespedes"] as $huesped) {
            echo $huesped->tarjetaHuesped();
        }
        ?>
    </main>
</body>

</html>