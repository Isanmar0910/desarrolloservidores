<?php

class db
{
    private const DATABASE_NAME = "museo";
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

    public function getConexion(): \PDO
    {
        return $this->pdo;
    }

    public function getAll(): array
    {
        $consulta = $this->pdo->query("SELECT * FROM pieza ORDER BY nombre;");
        return $consulta->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function numPiezas(){
        $consulta = $this->pdo->query("SELECT COUNT(*) FROM pieza;");

        return $consulta->fetchColumn();
    }


    public function sumPiezas(){
        $consulta = $this->pdo->query("SELECT SUM(valor) FROM pieza;");

        return $consulta->fetchColumn();
    }
}
