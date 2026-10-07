<?php

$temas = [
    "claro"  => ["fondo" => "#F5F7F6", "tinta" => "#1F2933"],
    "oscuro" => ["fondo" => "#1E2723", "tinta" => "#E8F0EC"],
    "calido" => ["fondo" => "#FFF1DC", "tinta" => "#653C20"],
    "frio"   => ["fondo" => "#E8F3F8", "tinta" => "#193A4A"],
];

$duracion = time() + 60 * 60 * 24 * 30;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post">
        <label>Nombre:
            <input type="text" name="nombre" required>
        </label>
        <br><br>
        <label>Tema:
            <select name="tema">
                <option value="claro">Claro</option>
                <option value="oscuro">Oscuro</option>
                <option value="calido">Cálido</option>
                <option value="frio">Frío</option>
            </select>
        </label>
        <br><br>
        <button type="submit" name="guardar">Guardar</button>
    </form>


</body>

</html>