<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getigeti</title>
</head>

<body>
    <form action="procesarGet.php" method="get">
    
    <?php

        $edad = $_GET["edad"]??"-";

        echo "Hola, $_GET[nombre], tienes $_GET[edad] años.<br/>";

    ?>
    </form>
</body>

</html>