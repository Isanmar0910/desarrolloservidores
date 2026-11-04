
<?php
$guardado = false;
$tema = $_COOKIE["tema"] ?? "claro";

if (empty($_COOKIE["usuario"]) && !empty($_POST["usuario"])) {
    setcookie("usuario", $_POST["usuario"], time() + 30 * 24 * 60 * 60);
    setcookie("tema", $_POST["tema"], time() + 30 * 24 * 60 * 60);

    $mensaje = "Hola " . $_POST["usuario"];
    $guardado = true;
} elseif (isset($_COOKIE["usuario"])) {
    $mensaje = "Hola " . $_COOKIE["usuario"];
}

if (empty($_POST["tema"])) {
    $tema = $_COOKIE["tema"] ?? "claro";
} elseif (!empty($_POST["usuario"]) && isset($_POST["tema"])) {
    $tema = $_POST["tema"];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .claro {
            background: #F5F7F6;
            color: #1F2933;
        }

        .oscuro {
            background: #1E2723;
            color: #E8F0EC;
        }

        .calido {
            background: #FFF1DC;
            color: #653C20;
        }

        .frio {
            background: #E8F3F8;
            color: #193A4A;
        }
    </style>
</head>

<body class="<?= $tema ?>">
    <?php if ($guardado || isset($_COOKIE["usuario"])): ?>

        <h1><?= $mensaje ?></h1>

    <?php else: ?>

        <form action="3b.php" method="post">
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" required>

            <select name="tema" id="tema">
                <option value="claro">Claro</option>
                <option value="oscuro">Oscuro</option>
                <option value="frio">Frío</option>
                <option value="calido">Cálido</option>
            </select>

            <button type="submit">Enviar</button>
        </form>

    <?php endif; ?>
</body>

</html>
