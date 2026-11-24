<?php

enum TipoMedicion : string{
    case temperatura = 'temperatura';
    case humedad = 'humedad';
    case presionAtmosferica = 'presion atmosferica';
}

class Medicion {
    private int $id;
    private string $ubicacion;
    private TipoMedicion $tipo;
    private float $valor;
    private string $fecha;

    public function __construct(int $id,string $ubicacion,TipoMedicion $tipo,float $valor,string $fecha) {
        $this->id = $id;
        $this->ubicacion = $ubicacion;
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->fecha = $fecha;
    }
}

class MedicionFactory{


    public static function crear(array $i): Medicion{
        return new Medicion((int)$i["id"], $i["ubicacion"], TipoMedicion::from($i["tipo_medicion"]),(float)$i["valor"],$i["fecha_hora"]);
    }
}

class MedicionRepository{
    private const DATABASE_NAME = "metereologia";
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


    public function obtenerTodas(): array{
        $consulta = $this->pdo->query("SELECT * FROM medicion;");

        $filas = $consulta->fetchALL(\PDO::FETCH_ASSOC);

        $mediciones = [];

        foreach($filas as $f){
            $mediciones[] = MedicionFactory::crear($f);
        }

        return $mediciones;
    }

    public function buscarPorIdentificador(int $id): ?Medicion{
        $consulta = $this->pdo->prepare("SELECT * FROM medicion WHERE id = :id;");

            $consulta->bindParam(":id" , $id, \PDO::PARAM_INT);
            $consulta->execute();

            $i = $consulta->fetch(\PDO::FETCH_ASSOC);

            if ($i == false) {
                return null;
            }

            return MedicionFactory::crear($i);

    }

    public function buscarPorTipo(TipoMedicion $tipo): array{
        $consulta = $this->pdo->prepare("SELECT * FROM medicion WHERE tipo_medicion = :tipo;");

        

        $consulta->bindValue(":tipo", $tipo->value, \PDO::PARAM_STR);
        $consulta->execute();

        $i = $consulta->fetchALL(\PDO::FETCH_ASSOC);
        $mediciones = [];

        foreach($i as $v){
            $mediciones[] = MedicionFactory::crear($v);
        }

        return $mediciones;
    }
}
