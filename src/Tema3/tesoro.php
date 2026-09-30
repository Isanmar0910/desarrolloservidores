<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 20</title>
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
    <table>
        <tbody>
            <tr>

                <?php

                $fondo = 0;

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

                for ($i = 1; $i <= 100; $i++):

                    if ($i == $llave) {
                        $texto = "🔑";
                    } elseif ($i == $cofre) {
                        $texto = "🔒";
                    } elseif ($i == $trampa) {
                        $texto = "💥";
                    } elseif ($i == $tesoro) {
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

    <form action="tesoro.php" method="get">
        <br>
        
        <label for="numero">Posicion</label>
        <input id="numero" type="number" name="posicion" min="1" max="100" autofocus require />
        <button>Enviar</button>
    </form>
</body>

</html>