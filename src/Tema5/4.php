<?php

if (!isset($_COOKIE["fecha"])) {
    $mensaje = "Esta es tu primera visita";

    setcookie("fecha",date('Y-m-d H:i:s'));

}else {
    $mensaje = "tu ultima visita fue ".$_COOKIE["fecha"];
    setcookie("fecha",date('Y-m-d H:i:s'));
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
    <p><?= $mensaje ?></p>
</body>

</html>