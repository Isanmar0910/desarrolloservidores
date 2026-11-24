<?php

require_once 'clases/db.php';

$baseDatos = new db();
// $museos = $baseDatos->getAll();
$museos = $baseDatos->sumPiezas();

// Para ver qué te ha devuelto:

echo "<pre>";
print_r($museos);
echo "</pre>";


