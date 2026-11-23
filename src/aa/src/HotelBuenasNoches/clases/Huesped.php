<?php

class Huesped
{
    public private(set) int $numero;

    public string $nombreCompleto {
        get => $this->nombrePila . " " . $this->apellidos;
    }

    public function __construct(
        int $numero,
        public private(set) string $nombrePila,
        public private(set) string $apellidos,
        public private(set) int $telefono,
        public private(set) string $email,
        public private(set) string $id,
    ) {
        $this->numero = $numero;
    }

    public function tarjetaHuesped(): string
    {
        return "<article>
        <h2>Huésped #$this->numero — $this->nombreCompleto</h2>
        <p>Tipo de monstruo: $this->id</p>
        <p>Teléfono: <span>$this->telefono</span></p>
    </article>";
    }
}