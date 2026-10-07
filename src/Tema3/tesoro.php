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

                if (isset($_POST["posicion"])) {

                    $llave = $_POST["llave"];
                    $cofre = $_POST["cofre"];
                    $trampa = $_POST["trampa"];
                    $tesoro = $_POST["tesoro"];

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
                }elseif(empty($_POST["posicion"])) {


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
                }

                ?>
            </tr>
        </tbody>
    </table>

    <!-- Formulario -->

    <form action="tesoro.php" method="post">
        <br>

        <label for="numero">Posicion</label>
        <input id="numero" type="number" name="posicion" min="1" max="100" autofocus required />
        <input type="hidden" name="tesoro" value="<?php echo $tesoro; ?>">
        <input type="hidden" name="cofre" value="<?php echo $cofre; ?>">
        <input type="hidden" name="trampa" value="<?php echo $trampa; ?>">
        <input type="hidden" name="llave" value="<?php echo $llave; ?>">
        <button>Enviar</button>
    </form>

    <?php

    $intento = $_POST["posicion"] ?? "";
    $diamante = $_POST["tesoro"] ?? "";
    $ver = "";
    $verF = "";
    

    if ($intento == $tesoro) {
        echo "Enhorabuena has acertado la posicion del diamante W aura 67";
        $ver = "none";
    } elseif (empty($intento)) {
        echo "tienes que asignar un valor";
    } else {
        echo "Illo espabila que has fallao";
    }

    ?>

    <!-- <br>
    <a href="tesoro.php" style="display: <?php echo $ver; ?>">Intentalo otra ve maquina</a>
    <a href="tesoro.php" style="display: <?php echo $ver; ?>">Intentalo otra ve maquina</a> -->
    <!-- investiga a ve si se puede pasa un arrai omg con get o post -->
     <a href="http://localhost:8080/Tema3/tesoro.php"><button>Ir a la página</button></a>
     <button onclick= "location.href = `http://localhost:8080/Tema3/tesoro.php`">aaaaa</button>
</body>

</html>