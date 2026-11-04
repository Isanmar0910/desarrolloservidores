<?php

$habitaciones = [
    ["Numero" => 13, "Habitacion" => "Cripta Real", "Precio/Noche" => 120, "Capacidad" => 2, "Estado" => "Disponible"],
    ["Numero" => 66, "Habitacion" => "Laboratorio Frankestain", "Precio/Noche" => 95, "Capacidad" => 3, "Estado" => "Disponible"],
    ["Numero" => 99, "Habitacion" => "Sarcofrago Imperial", "Precio/Noche" => 150, "Capacidad" => 2, "Estado" => "Disponible"],
    ["Numero" => 404, "Habitacion" => "Suite Fantasmal", "Precio/Noche" => 80, "Capacidad" => 1, "Estado" => "Disponible"],
    ["Numero" => 666, "Habitacion" => "Guarida del Hombre Lobo", "Precio/Noche" => 110, "Capacidad" => 2, "Estado" => "Ocupada"]
];

function calcularEstancia(float $precio, int $noches): float
{
    return $precio * $noches;
}

function verHabitaciones(array $habitaciones): void
{
    foreach ($habitaciones as $habitacion) {
        echo "<tr>";
        echo "<td>" . $habitacion["Numero"] . "</td>";
        echo "<td>" . $habitacion["Habitacion"] . "</td>";
        echo "<td>" . $habitacion["Precio/Noche"] . " €</td>";
        echo "<td>" . $habitacion["Capacidad"] . "</td>";
        echo "<td>" . $habitacion["Estado"] . "</td>";
        echo "<td>";
        if ($habitacion["Estado"] == "Disponible") {
            echo "<input type='radio' name='habitacion' value='" . $habitacion["Numero"] . "'>";
        } else {
            echo "<input type='radio' name='habitacion' disabled>";
        }
        echo "</td>";
    }
}
