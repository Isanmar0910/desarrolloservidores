<?php 
require_once 'bd.php';

$bd = new bd();

if (!empty($_POST)) {
    $averia = $bd->registrarReparacion($_POST["cliente"], $_POST["modelo"], $_POST["descripcion"]);
}

$reparaciones = $bd->getAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="cliente">Nombre del Cliente:</label>
        <input type="text" name="cliente" id="cliente"><br>
        <label for="modelo">Introduce el Modelo de su bicicleta: </label>
        <input type="text" name="modelo" id="modelo"><br>
        <label for="descripcion">Descripcion de la averia </label>
        <input type="text" name="descripcion" id="descripcion"><br>
        <button>Enviar</button>
    </form>    

    <?php if (isset($averia)): ?>
        <p>ID de la reparación registrada: <?php echo $averia; ?></p>
    <?php endif; ?>

    <h2>Listado de Reparaciones</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Modelo</th>
            <th>Avería</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($reparaciones as $rep): ?>
            <tr>
                <td><?php echo $rep['id']; ?></td>
                <td><?php echo $rep['cliente']; ?></td>
                <td><?php echo $rep['modelo']; ?></td>
                <td><?php echo $rep['averia']; ?></td>
                <td><?php echo $rep['fecha']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
