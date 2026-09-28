<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <style>
        ul { list-style-type: none};
        li { font-weight: bold};
        .par {color: #EC35FE};
        .impar {color: #35FEED};
    </style>
    <ul>
        
        <?php 
        for ($i = 1; $i <= 100; $i++):
            echo "<li class=\"" . (($i%2==0)?"par":"impar")  ."\">$i</li>\n";
        endfor;
        
        ?>
    
    
    </ul>
</body>
</html>