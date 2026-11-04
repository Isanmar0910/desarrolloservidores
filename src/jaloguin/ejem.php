<?php

$habitaciones = [
    ["Numero" => 13, "Habitacion" => "Cripta Real", "Precio/Noche" => 120, "Capacidad" => 2, "Estado" => "Disponible"],
    ["Numero" => 66, "Habitacion" => "Laboratorio Frankestain", "Precio/Noche" => 95, "Capacidad" => 3, "Estado" => "Disponible"],
    ["Numero" => 99, "Habitacion" => "Sarcofrago Imperial", "Precio/Noche" => 150, "Capacidad" => 2, "Estado" => "Disponible"],
    ["Numero" => 404, "Habitacion" => "Suite Fantasmal", "Precio/Noche" => 80, "Capacidad" => 1, "Estado" => "Disponible"],
    ["Numero" => 666, "Habitacion" => "Guarida del Hombre Lobo", "Precio/Noche" => 110, "Capacidad" => 2, "Estado" => "Ocupada"]
];


$foo = function($item){

    return $item +1;
}

$suma = array_map($foo, $habitaciones["Capacidad"]);

print_r($habitaciones);
print_r($suma);

?>  