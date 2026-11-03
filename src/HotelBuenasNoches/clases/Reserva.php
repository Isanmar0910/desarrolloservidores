<?php

class Reserva
{
    public private(set) bool $estado;

    public function __construct(
        public readonly int $id,
        public private(set) Huesped $huesped,
        public private(set) Habitacion $habitacion,
        public private(set) int $numNoches,
    ) {
        if (!$habitacion->estado) {
            throw new InvalidArgumentException("La habitación no está disponible");
        }
        if ($numNoches < 1) {
            throw new InvalidArgumentException("La estancia debe ser de al menos una noche");
        }

        $habitacion->ocupar();
        $this->estado = true;
    }

    public function calcularImporte(): float
    {
        return $this->habitacion->precioNoche * $this->numNoches;
    }

    public function cancelar(): void
    {
        $this->estado = false;
        $this->habitacion->liberar();
    }
}