<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

        $numeros = array();
        $usados = array();

        for ($fila=0; $fila < 6; $fila++) { 
            for ($colum=0; $colum < 9; $colum++) { 

                do {
                    $numero = rand(100,999);
                } while (in_array($numero, $usados));

                $usados[] = $numero;
                $numeros[$fila][$colum] = $numero;
            }
        }

        
        $minimo = 1000;
        $filaMin = 0;
        $columMin = 0;

        for ($fila=0; $fila < 6; $fila++) { 
            for ($colum=0; $colum < 9; $colum++) { 
                if ($numeros[$fila][$colum] < $minimo) {
                    $minimo = $numeros[$fila][$colum];
                    $filaMin = $fila;
                    $columMin = $colum;
                }
            }
        }

        echo "<table border='1' cellpadding='5'>";
        for ($fila=0; $fila < 6; $fila++) { 
            echo "<tr>";
            for ($colum=0; $colum < 9; $colum++) { 

                if ($fila == $filaMin && $colum == $columMin) {
                    $color = "blue";
                } elseif ($fila - $colum == $filaMin - $columMin || $fila + $colum == $filaMin + $columMin) {
                    $color = "green";
                } else {
                    $color = "black";
                }

                echo "<td style='color:" . $color . ";'>" . $numeros[$fila][$colum] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    
    ?>
</body>
</html>