<?php
session_start();
require_once "secreto.php";

$fin = false;
$acierto = false;

if (!empty($_POST["reiniciar"])) {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}

if (!empty($_POST["siguiente"])) {
    $acierto = false;
    $_SESSION["puerta"]++;
    generacion($_SESSION["puerta"]);
    header("Location: index.php");
    exit;
}

if (empty($_SESSION["codigo"]) && $acierto == false) {
    $_SESSION["puerta"] = 1;
    generacion($_SESSION["puerta"]);
}

$mensaje = "";
$mensajeIntento = "";
$valido = null;

if (isset($_POST["codigo"])) {
    $valido = comprobacion(codigo: $_POST["codigo"], min: $_SESSION["min"], max: $_SESSION["max"]);

    if ($valido === null) {
        $mensaje = "<p>El campo está vacío</p>";
    } elseif ($valido === false) {
        $mensaje = "<p>Formato incorrecto: solo cifras y la longitud exacta</p>";
    } elseif ((int)$_POST["codigo"] === $_SESSION["codigo"]) {
        $mensaje = "<p>ヾ(≧▽≦*) DESBLOQUEADO AURA W 67</p>";
        $acierto = true;
    } else {
        $_SESSION["intentos"]++;
        $mensaje = "<p>┗|｀O′|┛ Código Erróneo</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desbloqueo de Código</title>
</head>

<body>
    <h2>Puerta Numero <?= $_SESSION["puerta"] ?></h2>
    <p>Número aleatorio: <?= $_SESSION["codigo"] ?></p>
    <p>Intentos realizados: <?= $_SESSION["intentos"] ?></p>

    <?php if ($_SESSION["intentos"] < $_SESSION["maxIntent"] && $acierto == false): ?>
        <form action="index.php" method="post">
            <label for="codigo">Introduce el Código para desbloquear</label>
            <input type="number" name="codigo" id="codigo" required autofocus><br>
            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>
    <?= $mensaje ?><br>
    <?= $valido === true ? pistas() : "" ?>
    <?php if ($_SESSION["intentos"] >= $_SESSION["maxIntent"]): $fin = true; ?>
        <h3>🔐 PUERTA BLOQUEADA TE VOA MATA</h3>
    <?php elseif (!empty($_POST["codigo"]) && $_SESSION["codigo"] == $_POST["codigo"]): $fin = true;
        $acierto = true;  ?>
        <h3>ABIERTO MAQUINISTA</h3>
    <?php endif; ?>
    <?php if ($fin == true): ?>
        <form action="index.php" method="post">
            <button name="reiniciar" id="reiniciar" value="1">Nueva Party</button>
        </form>
    <?php endif; ?>
    <?php if ($acierto == true): ?>
        <form action="index.php" method="post">
            <button name="siguiente" id="siguiente" value="1">Siguiente Dor</button>
        </form>
    <?php endif; ?>
</body>

</html>