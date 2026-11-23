<?php

class Habitacion
{
    public function __construct(
        public readonly int $nHabitacion,
        public private(set) string $nombre,

        public float $precioNoche {
            set {
                if ($value <= 0) {
                    throw new InvalidArgumentException("Precio no válido");
                } else {
                    $this->precioNoche = $value;
                }
            }
        },

        public private(set) int $maxCap {
            set {
                if ($value < 1) {
                    throw new InvalidArgumentException("Tiene que ser como minimo 1 persona");
                } else {
                    $this->maxCap = $value;
                }
            }
        },

        public private(set) bool $estado = true,
    ) {}

    public function tarjetaHabitacion(): string
    {
        $textoEstado = $this->estado ? "Disponible" : "Ocupada";

        return "<article>
        <h2>Habitación $this->nHabitacion — $this->nombre</h2>
        <p>Precio por noche: $this->precioNoche €</p>
        <p>Capacidad: $this->maxCap huéspedes</p>
        <p>Estado: <span>$textoEstado</span></p>
    </article>";
    }

    public function importeEstancia(int $nNoches): float
    {

        if ($nNoches >= 1) {
            return  $this->precioNoche * (float)$nNoches;
        } else {
            throw new InvalidArgumentException("El numero de noches tiene que ser mayor que 0");
        }
    }

    public function ocupar(): void
    {
        $this->estado = false;
    }

    public function liberar(): void
    {
        $this->estado = true;
    }
}
