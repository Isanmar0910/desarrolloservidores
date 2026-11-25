<?php 

require_once __DIR__ . '/EstadoSenal.php';
require_once __DIR__ . '/Conexion.php';


class Senal {

    public private(set) ?int $identificador = null;
    public readonly string $codigo;
    public string $estacion;

    public float $frecuencia{
        set{
            if ($value > 0) {
                $this->frecuencia = $value;
            }else {
                throw new InvalidArgumentException("Debe ser mayor a 0");
            }
        }
    }

    public int $intensidad {
        set{
            if ($value >= 1 && $value <= 100) {
                $this->intensidad = $value;
            }else {
                throw new InvalidArgumentException("Debe estar comprendido entre 1 y 100");
            }
        }
    }

    public private(set) EstadoSeñal $estado;

    public bool $prioritaria{
        get => $this->intensidad >= 80 && $this->estado === EstadoSeñal::PENDIENTE;
    }

    public function __construct(string $codigo, string $estacion, float $frecuencia, int $intensidad, EstadoSeñal $estado = EstadoSeñal::PENDIENTE, ?int $identificador = null)
    {
        $this->codigo = $codigo;
        $this->estacion = $estacion;
        $this->frecuencia = $frecuencia;
        $this->intensidad = $intensidad;
        $this->estado = $estado;
        $this->identificador = $identificador;
    }

    public static function crear(array $x): Senal{
        return new Senal( $x['codigo'], $x['estacion'], (float) $x['frecuencia'], (int) $x['intensidad'], EstadoSeñal::from($x['estado']), (int) $x['identificador']);
    }

    public static function obtenerTodas(): array{
        $pdo = conectar();

        $sql = $pdo->query("SELECT * FROM senal ORDER BY intensidad DESC;");
        $senal = $sql->fetchAll(\PDO::FETCH_ASSOC);

        $senales = [];

        foreach($senal as $s){
            $senales[] = self::crear($s);
        }

        return $senales;
    }

    public function guardar(): void{
        $pdo = conectar();

        if ($this->identificador == null) {
            $sql = $pdo->prepare("INSERT INTO senal(codigo, estacion, frecuencia, intensidad, estado)
                                    VALUES (?, ? , ?, ? ,?)");
            $sql->execute([$this->codigo, $this->estacion, $this->frecuencia, $this->intensidad, $this->estado->value]);
            $this->identificador = (int)$pdo->lastInsertId();

        }else {
            $sentencia = $pdo->prepare(
                "UPDATE senal SET codigo = ?, estacion = ?, frecuencia = ?, intensidad = ?, estado = ? WHERE identificador = ?"
            );
            $sentencia->execute([$this->codigo, $this->estacion, $this->frecuencia, $this->intensidad, $this->estado->value, $this->identificador]);
        }
    }

    public static function buscar(int $id): ?Senal{
        $pdo = conectar();

        $sql = $pdo->prepare("SELECT * FROM senal WHERE identificador = :id");
        $sql->bindParam(":id", $id, \PDO::PARAM_INT);
        $sql->execute();

        $obj = $sql->fetch(\PDO::FETCH_ASSOC);

        if ($obj === false) {
            return null;
        }

        return self::crear($obj);
    }

    public function confirmar(): bool{
        $completado = false;

        if ($this->estado === EstadoSeñal::PENDIENTE && $this->identificador !== null) {
            $this->estado = EstadoSeñal::CONFIRMADA;

            $pdo = conectar();
            $sql = $pdo->prepare("UPDATE senal SET estado = :estado WHERE identificador = :id;");
            $sql->bindValue(":estado", $this->estado->value, \PDO::PARAM_STR);
            $sql->bindValue(":id", $this->identificador, \PDO::PARAM_INT);
            $sql->execute();

            $completado = true;
        }

        return $completado;
    }

    public function descartar(): bool{
        $completado = false;

        if ($this->estado === EstadoSeñal::PENDIENTE && $this->identificador !== null) {
            $this->estado = EstadoSeñal::DESCARTADA;

            $pdo = conectar();
            $sql = $pdo->prepare("UPDATE senal SET estado = :estado WHERE identificador = :id;");
            $sql->bindValue(":estado", $this->estado->value, \PDO::PARAM_STR);
            $sql->bindValue(":id", $this->identificador, \PDO::PARAM_INT);
            $sql->execute();

            $completado = true;
        }

        return $completado;
    }

    public static function obtenerPorEstado(EstadoSeñal $estado): array{
        $pdo = conectar();

        $sql = $pdo->prepare("SELECT * FROM senal WHERE estado LIKE :estado;");
        $sql->bindValue(":estado", "%" . $estado->value . "%", \PDO::PARAM_STR);
        $sql->execute();

        $obj = $sql->fetchAll(\PDO::FETCH_ASSOC);

        $array = [];

        foreach($obj as $o){
            $array[] = self::crear($o);
        }

        return $array;
    }

}

?>
