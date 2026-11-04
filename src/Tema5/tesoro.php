<?php
session_start();

if (isset($_POST["reinicio"])) {
    session_destroy();
    header("Location: tesoro.php");
    exit;
}

// 🔑 🔒 💥 💎//
$figuras = [];
$mensaje = "";
$numero = $_POST["numero"] ?? "";
$inventario = "Inventario: ";

if (empty($_SESSION["posiciones"])) {

    for ($i = 0; $i < 4; $i++):
        do {
            $posicion = rand(1, 100);
        } while (in_array($posicion, $figuras));

        $figuras[] = $posicion;
    endfor;

    $_SESSION["posiciones"] = $figuras;
    $_SESSION["llave"] = "";
} else {
    $figuras = $_SESSION["posiciones"];
}

$llave = $_SESSION["llave"];


if (isset($_POST["numero"])) {

    switch ($_POST["numero"]) {
        case $figuras[0]:
            $mensaje = "Has encontrado la llave";
            $llave = true;
            break;
        case $figuras[1]:
            if (!$llave) {
                $mensaje = "Debes encontrar la llave para poder abir el candado";
            } else {
                $mensaje = "Aura W has abierto el ki";
                $llave = "";
            }
            break;
        case $figuras[2]:
            $mensaje = "Ups explosao";
            break;
        case $figuras[3]:
            $mensaje = "diamante HAS GANDAO";
            break;

        default:
            # code...
            break;
    }
}

$_SESSION["llave"] = $llave;

if ($llave) {
    $inventario = "Inventario: 🔑";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        table {
            border: 1px, solid #000
        }

        ul {
            list-style-type: none;
        }

        li {
            font-weight: bold;
        }

        .fondo {
            background-color: #07c28475;
        }

        .omg {
            background-color: #9f119f;
        }
    </style>


    <table>
        <tbody>
            <tr>
                <?php
                $fondo = 1;



                for ($i = 1; $i <= 100; $i++):
                ?>
                    <td class=<?= ($fondo % 2 == 0) ? "omg" : "fondo" ?>>
                        <?php
                        switch ($i) {
                            case $figuras[0]:
                                echo "🔑";

                                break;
                            case $figuras[1]:
                                echo "🔒";
                                break;
                            case $figuras[2]:
                                echo "💥";
                                break;
                            case $figuras[3]:
                                echo "💎";
                                break;

                            default:
                                echo str_pad($i, 3, "0", STR_PAD_LEFT);
                                break;
                        }

                        $fondo++;
                        ?>

                    </td>
                    <?php
                    if ($i % 10 == 0 && $i < 100):
                        $fondo++;
                    ?>
            </tr>
            <tr>
            <?php endif; ?>
        <?php endfor; ?>
            </tr>
        </tbody>
    </table>
    <?php if ($numero != $figuras[3] && $numero != $figuras[2]): ?>
        <form action="tesoro.php" method="post">
            <label for="numero">Posicion:</label>
            <input type="number" name="numero" id="numero" min=1 max=100>
            <button>Enviar</button>
        </form>
    <?php endif ?>

    <form action="tesoro.php" method="post">
        <input type="submit" value="Iniciar Nueva Pari" name="reinicio">
    </form>
    <p><?= $inventario ?></p>
    <p><?= $mensaje ?></p>

</body>

</html>