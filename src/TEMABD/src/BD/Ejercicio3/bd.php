<?php

class bd
{

    private const DATABASE_NAME = "taller";
    private const DATABASE_USER = "root";
    private const DATABASE_PASS = "1234";

    private \PDO $pdo;

    public function __construct()
    {
        try {

            $dsn = "mysql:host=db;dbname=" . self::DATABASE_NAME . ";charset=utf8";
            $this->pdo = new \PDO($dsn, self::DATABASE_USER, self::DATABASE_PASS);
        } catch (\PDOException $pdoe) {
            throw new \RuntimeException("**ERROR: No se pudo establecer una conexión con la base de datos.");
        }
    }


    public function registrarReparacion(string $cliente, string $modelo, string $desc)
    {

        $fecha = date('Y-m-d H:i:s');

        $inyeccion = $this->pdo->prepare("INSERT INTO reparacion(cliente, modelo, averia, fecha)
                                            VALUES (:cliente, :modelo, :averia, :fecha)");

        $inyeccion->bindParam(':cliente', $cliente, PDO::PARAM_STR);
        $inyeccion->bindParam(':modelo', $modelo, PDO::PARAM_STR);
        $inyeccion->bindParam(':averia', $desc, PDO::PARAM_STR);
        $inyeccion->bindParam(':fecha', $fecha, \PDO::PARAM_STR);


        $inyeccion->execute();

        return $this->pdo->lastInsertId();

    }

        public function getAll(): array
    {
        $consulta = $this->pdo->query("SELECT * FROM reparacion");
        return $consulta->fetchAll(\PDO::FETCH_ASSOC);
    }
}
