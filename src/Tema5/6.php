<?
session_start();


if (isset($_POST["productos"])) {
    $_SESSION["carrito"][] = $_POST["productos"];
}

if (isset($_POST["Eliminar"]) && isset($_SESSION["carrito"])) {
    foreach ($_SESSION["carrito"] as $clave => $i) {
        if (isset($_POST[$i])) {
            unset($_SESSION["carrito"][$clave]);
        }
    }
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
    <form action="6.php" method="post">
        <label for="productos">Elige un producto:</label>
        <select name="productos" id="productos">
            <option value="boniato">boniato</option>
            <option value="cigarra">cigarra</option>
            <option value="puro">puro</option>
            <option value="alfredo">alfredo</option>
        </select>
        <button>Enviar</button>
    </form>

    <form action="6.php" method="post">
        <input type="submit" name="verCarrito" value="Ver Carrito">
    </form>

<?php
if (isset($_POST["verCarrito"]) && isset($_SESSION["carrito"])) {

    echo " <form action='6.php' method='post'>";
    echo "<input type='hidden' name='verCarrito' value='1'>";
    foreach ($_SESSION["carrito"] as $i) {

        echo "<input type='checkbox' name='$i' id='$i' value='$i'> $i";
        echo "<br>";
    }
    echo " <input type='submit' name='Eliminar' value='Eliminar Carrito'>
            </form>";
}
?>

</body>

</html>