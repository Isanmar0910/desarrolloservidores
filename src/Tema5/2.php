<?php

if (!empty($_POST["reiniciar"])) {
    setcookie("contador", 0, time() + 3600);
    header("Location: 2.php");
} else {
    if (!isset($_COOKIE["contador"])) {
        $contador = 0;
    } else {
        $contador = $_COOKIE["contador"];
    }
    setcookie("contador", $contador + 1, time() + 3600);
    echo $contador;
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
    <form action="2.php" method="post">
        <input type="submit" value="Reiniciar Contador" id="reiniciar" name="reiniciar">
    </form>
</body>

</html>