<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>


<body>

    <?php

    if (isset($_POST["operacion"])):
        $x = $_POST["x"];
        $y = $_POST["y"];
        $operacion = $_POST["operacion"];


        switch ($operacion) {
            case 'suma':

                echo "La suma de " . $x . " y " . $y . " es igual a " . ($x + $y);

                break;
            case 'resta':
                echo "La resta de " . $x . " y " . $y . " es igual a " . ($x - $y);

                break;
            case 'multiplicacion':
                echo "La multiplicacion de " . $x . " y " . $y . " es igual a " . ($x * $y);

                break;
            case 'division':
                if ($y == "0") {
                    echo "No se puede dividir entre 0";
                } else {

                    echo "La division de " . $x . " y " . $y . " es igual a " . ($x / $y);
                }

                break;

            default:
                echo "inserta dos numeros";

                break;
        }

    endif;


    ?>

    <form action="7.php" method="post">
        <label for="x">Numero 1:</label>
        <input type="number" name="x" id="x">
        <br>
        <label for="y">Numero 2:</label>
        <input type="number" name="y" id="y">
        <br>
        <input type="radio" name="operacion" value="suma">Suma
        <br>
        <input type="radio" name="operacion" value="resta">Resta
        <br>
        <input type="radio" name="operacion" value="multiplicacion">Multiplicacion
        <br>
        <input type="radio" name="operacion" value="division">Division
        <br>
        <button>Enviar</button> <a href="http://localhost:8080/tema3/7.php"><button>Reiniciar</button></a>

    </form>




</body>

</html>