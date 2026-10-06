<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 22</title>
</head>

<body>
    <style>
        table {
            border: 1px solid #000;
        }

        ul {
            list-style-type: none;
        }

        li {
            font-weight: bold;
        }

        .par {
            color: #EC35FE;
        }

        .impar {
            color: #35FEED;
        }

        .parExotic {
            color: #EC35FE;
            background-color: #001;
        }

        .imparExotic {
            color: #35FEED;
            background-color: #001;
        }
    </style>

    <?php

    $fondo = 0;
    $fin = 0;
    $mensaje = "";

    if (isset($_POST["posicion"])) {

        // Recuperamos el estado de la partida
        $llave = $_POST["llave"];
        $cofre = $_POST["cofre"];
        $trampa = $_POST["trampa"];
        $tesoro = $_POST["tesoro"];
        $inventario = $_POST["inventario"];
        $intento = $_POST["posicion"];
        $descubiertas = $_POST["descubiertas"] ?? []; // NUEVO

        // NUEVO: apuntamos la casilla explorada (solo si es válida)
        if ($intento >= 1 && $intento <= 100) {
            $descubiertas[] = $intento;
        }

        // Comprobamos qué hay en la casilla
        if ($intento < 1 || $intento > 100) {
            $mensaje = "La casilla tiene que estar entre 1 y 100";
        } elseif ($intento == $tesoro) {
            $mensaje = "Enhorabuena has acertado la posicion del diamante W aura 67";
            $fin = 1;
        } elseif ($intento == $trampa) {
            $mensaje = "Has pisado la trampa 💥 has perdido";
            $fin = 1;
        } elseif ($intento == $llave) {
            $mensaje = "Has encontrado la llave 🔑 se ha añadido a tu inventario";
            $inventario = 1;
            $llave = 0;
        } elseif ($intento == $cofre) {
            if ($inventario == 1) {
                $mensaje = "Has abierto el cofre y has conseguido 100 monedas de oro";
                $cofre = 0;
            } else {
                $mensaje = "El cofre esta cerrado, necesitas la llave";
            }
        } else {
            $mensaje = "No has encontrado nada";
        }
    } else {

        // Partida nueva: colocamos los elementos al azar
        $llave = random_int(1, 100);
        do {
            $cofre = random_int(1, 100);
        } while ($cofre == $llave);
        do {
            $trampa = random_int(1, 100);
        } while ($trampa == $llave || $trampa == $cofre);
        do {
            $tesoro = random_int(1, 100);
        } while ($tesoro == $llave || $tesoro == $cofre || $tesoro == $trampa);

        $inventario = 0;
        $descubiertas = []; // NUEVO
        $mensaje = "Empieza la partida, elige una casilla";
    }

    ?>

    <table>
        <tbody>
            <tr>

                <?php

                for ($i = 1; $i <= 100; $i++):

                    // NUEVO: el emoji solo se muestra si la casilla está descubierta
                    if ($i == $llave && in_array($i, $descubiertas)) {
                        $texto = "🔑";
                    } elseif ($i == $cofre && in_array($i, $descubiertas)) {
                        $texto = "🔒";
                    } elseif ($i == $trampa && in_array($i, $descubiertas)) {
                        $texto = "💥";
                    } elseif ($i == $tesoro && in_array($i, $descubiertas)) {
                        $texto = "💎";
                    } elseif ($i < 10) {
                        $texto = "00$i";
                    } elseif ($i < 100) {
                        $texto = "0$i";
                    } else {
                        $texto = "$i";
                    }

                    if ($fondo % 2 == 0) {
                        echo "<td class=\"" . (($i % 2 == 0) ? "parExotic" : "imparExotic") . "\">$texto</td>\n";
                    } else {
                        echo "<td class=\"" . (($i % 2 == 0) ? "par" : "impar") . "\">$texto</td>\n";
                    }

                    $fondo++;

                    if ($i % 10 == 0 && $i <= 90) {
                        echo "</tr><tr>";
                        $fondo++;
                    }
                endfor;

                ?>
            </tr>
        </tbody>
    </table>

    <!-- Formulario -->

    <?php if ($fin == 0): ?>
        <form action="tesoroo.php" method="post">
            <br>

            <label for="numero">Posicion</label>
            <input id="numero" type="number" name="posicion" min="1" max="100" autofocus required />
            <input type="hidden" name="tesoro" value="<?php echo $tesoro; ?>">
            <input type="hidden" name="cofre" value="<?php echo $cofre; ?>">
            <input type="hidden" name="trampa" value="<?php echo $trampa; ?>">
            <input type="hidden" name="llave" value="<?php echo $llave; ?>">
            <input type="hidden" name="inventario" value="<?php echo $inventario; ?>">
            <!-- NUEVO: enviamos las casillas descubiertas como array -->
            <?php foreach ($descubiertas as $d): ?>
                <input type="hidden" name="descubiertas[]" value="<?php echo $d; ?>">
            <?php endforeach; ?>
            <button>Enviar</button>
        </form>
    <?php endif; ?>

    <p><?php echo $mensaje; ?></p>

    <p>Inventario: <?php echo ($inventario == 1) ? "🔑" : "vacio"; ?></p>

    <br>
    <a href="tesoroo.php"><button>Nueva partida</button></a>
</body>

</html>