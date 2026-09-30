<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getigeti</title>
</head>

<body>

    <?php

        $edad = $_GET["edad"]??"-";

        echo "Hola, $_GET[nombre], tienes $_GET[edad] años.<br/>";

    ?>

    <!-- <form action="procesarGet.php" method="get"> -->
    <form action="get.php" method="get">
        <label for="nombre">Introduce tu nombre: </label>
        <input id="nombre" type="text" name="nombre" autofocus>

        <br />

        <label for="edad">Introduce tu edad: </label>
        <input id="edad" type="number" name="edad" autofocus>

        <button>Enviar</button>

    </form>
</body>

</html>