<?php
function conectar()
{
    try {
        $dsn = "mysql:host=db;dbname=objetos_perdidos;charset=utf8";
        $pdo = new PDO($dsn, "root", "1234");
        return $pdo;
    } catch (PDOException $pdoe) {
        echo $pdoe->getMessage();
        return false;
    }
}

function buscarPorIdentificador($pdo, $id)
{
    $sql = "SELECT * FROM objeto WHERE identificador = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindValue(":id", $id);
    $consulta->execute();

    return $consulta->fetch(PDO::FETCH_ASSOC);
}

function buscarPorTexto($pdo, $texto){

    $sql = "SELECT * FROM objeto WHERE nombre LIKE :texto1 OR descripcion LIKE :texto2";
    $consulta = $pdo->prepare($sql);
    $busqueda = "%" . $texto . "%";
    $consulta->bindValue(":texto1", $busqueda);
    $consulta->bindValue(":texto2", $busqueda);
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_ASSOC);

}
