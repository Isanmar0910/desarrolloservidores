<?php
require "funciones.php";
$pdo = conectar();

$mensaje = "";
$resultados = [];
$buscado = false;

if ($pdo === false) {
    $mensaje = "No se ha podido conectar con la base de datos.";
} else {

    if (isset($_POST["buscarId"])) {
        $buscado = true;
        $identificador = trim($_POST["identificador"]);

        if ($identificador != "") {
            $objeto = buscarPorIdentificador($pdo, $identificador);
            if ($objeto !== false) {
                $resultados = [$objeto];
            }
        } else {
            $mensaje = "Introduce un identificador numérico.";
        }
    }

    if (isset($_POST["buscarTexto"])) {
        $buscado = true;
        $texto = trim($_POST["texto"]);

        if ($texto != "") {
            $resultados = buscarPorTexto($pdo, $texto);
        } else {
            $mensaje = "Introduce un texto para buscar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Objetos perdidos</title>
</head>
<body>
    <h1>Objetos perdidos</h1>

    <form method="post">
        <label>Identificador: <input type="text" name="identificador"></label>
        <input type="submit" name="buscarId" value="Buscar por identificador">
    </form>

    <form method="post">
        <label>Texto: <input type="text" name="texto"></label>
        <input type="submit" name="buscarTexto" value="Buscar por texto">
    </form>

    <?php if ($mensaje != "") { ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php } ?>

    <?php if ($buscado && count($resultados) > 0) { ?>
        <p>Objetos encontrados: <?php echo count($resultados); ?></p>
        <table>
            <tr>
                <th>Identificador</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Lugar</th>
                <th>Fecha</th>
            </tr>
            <?php foreach ($resultados as $fila) { ?>
            <tr>
                <td><?php echo ($fila["identificador"]); ?></td>
                <td><?php echo ($fila["nombre"]); ?></td>
                <td><?php echo ($fila["descripcion"]); ?></td>
                <td><?php echo ($fila["lugar"]); ?></td>
                <td><?php echo ($fila["fecha"]); ?></td>
            </tr>
            <?php } ?>
        </table>
    <?php } elseif ($buscado && $mensaje == "") { ?>
        <p>No se ha encontrado ningún objeto.</p>
    <?php } ?>
</body>
</html>