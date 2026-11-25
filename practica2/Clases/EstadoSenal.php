<?php 

    enum EstadoSeñal: string{
        case PENDIENTE = 'P';
        case CONFIRMADA = 'C';
        case DESCARTADA = 'D';


        public function descripcion(): string{
            return match ($this) {
                self::PENDIENTE=> 'Pendiente' ,
                self::CONFIRMADA=> 'Confirmada' ,
                self::DESCARTADA=> 'Descartada'
            };
        }

    }

?>