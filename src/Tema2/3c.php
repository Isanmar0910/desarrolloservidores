<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <style>
        table {border: 1px solid #000 ;}
        td { list-style-type: bold ;}
        ul { list-style-type: none ;}
        li { font-weight: bold ;}
        .par {color: #EC35FE ;}
        .impar {color: #35FEED ;  }
        .parExotic {color: #EC35FE ; background-color: #001}
        .imparExotic {color: #35FEED ; background-color: #001 }
    </style>
    <table>
        <tbody>
            <tr>

        <?php 

        $numeroExotic = random_int(1,100);

         echo "<td>🐱‍👤</td>";
        for ($i = 1; $i <= 100; $i++):
            
            if (condition) {
                # code...
            }
            if ($i <10) {
                echo "<td class=\"" . (($i%2==0)?"par":"impar")  ."\">00$i</td>\n";
            }elseif ($i <100){
                echo "<td class=\"" . (($i%2==0)?"par":"impar")  ."\">0$i</td>\n";
            }else {
                echo "<td class=\"" . (($i%2==0)?"par":"impar")  ."\">$i</td>\n";
            }

            
            

            if ($i%10 == 0 && $i<=90) {
                echo "🐱‍👤</tr><tr>";
                echo "<td>🐱‍👤</td>";
            }

            

        endfor;
        
        ?>
        </tr>
        </tbody>
    </table>
</body>
</html>