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

$mensaje = "";
$error = "";


if (isset($_POST["reservar"])) {
    try {
        $numHuesped = (int)$_POST["huesped"];
        $numHabitacion = (int)$_POST["habitacion"];
        $noches = (int)$_POST["noches"];

        if (!isset($_SESSION["huespedes"][$numHuesped])) {
            throw new InvalidArgumentException("Selecciona un huésped");
        }
        if (!isset($_SESSION["habitaciones"][$numHabitacion])) {
            throw new InvalidArgumentException("Selecciona una habitación");
        }

        $nuevoId = $_SESSION["idReserva"] + 1;
        $reserva = new Reserva(
            $nuevoId,
            $_SESSION["huespedes"][$numHuesped],
            $_SESSION["habitaciones"][$numHabitacion],
            $noches
        );

        
        $_SESSION["reservas"][$nuevoId] = $reserva;
        $_SESSION["idReserva"] = $nuevoId;

        $mensaje = "Reserva realizada. Importe: " . number_format($reserva->calcularImporte(), 2) . " €";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}


if (isset($_POST["cancelar"])) {
    try {
        $idReserva = (int)$_POST["cancelar"];

        if (!isset($_SESSION["reservas"][$idReserva])) {
            throw new InvalidArgumentException("La reserva no existe");
        }
        $reserva = $_SESSION["reservas"][$idReserva];

        if (!$reserva->estado) {
            throw new InvalidArgumentException("Esa reserva ya estaba cancelada");
        }

        $reserva->cancelar();
        $mensaje = "Reserva cancelada y habitación liberada";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
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
        <?php
        if ($mensaje != "") {
            echo "<p class='ok'>$mensaje</p>";
        }
        if ($error != "") {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <h2>Nueva reserva</h2>
        <?php if (count($_SESSION["huespedes"]) == 0) { ?>
            <p>Primero tienes que registrar algún huésped.</p>
        <?php } else { ?>
            <form method="post" action="reservas.php">
                <label>Huésped:</label>
                <select name="huesped">
                    <?php
                    foreach ($_SESSION["huespedes"] as $huesped) {
                        echo "<option value='$huesped->numero'>$huesped->nombreCompleto</option>";
                    }
                    ?>
                </select>

                <label>Habitación disponible:</label>
                <select name="habitacion">
                    <?php
                    foreach ($_SESSION["habitaciones"] as $habitacion) {
                        if ($habitacion->estado) {
                            echo "<option value='$habitacion->nHabitacion'>$habitacion->nHabitacion - $habitacion->nombre ($habitacion->precioNoche €)</option>";
                        }
                    }
                    ?>
                </select>

                <label>Número de noches:</label>
                <input type="number" name="noches" value="1">

                <button type="submit" name="reservar">Reservar</button>
            </form>
        <?php } ?>

        <h2>Reservas realizadas</h2>
        <?php if (count($_SESSION["reservas"]) == 0) { ?>
            <p>Todavía no hay reservas.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Huésped</th>
                    <th>Habitación</th>
                    <th>Noches</th>
                    <th>Importe</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
                <?php foreach ($_SESSION["reservas"] as $reserva) { ?>
                    <tr>
                        <td><?php echo $reserva->id; ?></td>
                        <td><?php echo $reserva->huesped->nombreCompleto; ?></td>
                        <td><?php echo $reserva->habitacion->nombre; ?></td>
                        <td><?php echo $reserva->numNoches; ?></td>
                        <td><?php echo number_format($reserva->calcularImporte(), 2); ?> €</td>
                        <td><?php echo $reserva->estado ? "Activa" : "Cancelada"; ?></td>
                        <td>
                            <?php if ($reserva->estado) { ?>
                                <form method="post" action="reservas.php">
                                    <button type="submit" name="cancelar" value="<?php echo $reserva->id; ?>">Cancelar</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </main>
</body>
</html>