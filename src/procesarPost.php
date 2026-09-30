<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getigeti</title>
</head>

<body>
    <form action="procesarPost.php" method="POST">
    
    <?php

        // $edad = empty($_POST["edad"])?"-":$_POST["edad"];

        $edad = ($_POST["edad"]??"")?:"-";


        echo "Hola, $_POST[nombre], tienes $edad años.<br/>";

    ?>
    </form>
</body>

</html>