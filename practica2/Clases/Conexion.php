<?php

function conectar(): PDO
{
    try {
        static $pdo = null;
        if ($pdo === null) {
            $dsn = "mysql:host=mysql;dbname=lostsignal;charset=utf8";
            $pdo = new \PDO($dsn, "root", "root");
        }

        return $pdo;
    } catch (\PDOException $pdoe) {
        throw new \RuntimeException("**ERROR: No se pudo establecer una conexión con la base de datos.");
    }
}
