<?php

require_once __DIR__ . '/Clases/Senal.php';

echo "<pre>";

echo "=== 1. CREAR Y GUARDAR NUEVAS SEÑALES ===\n";
$s1 = new Senal("SIG-001", "Estación Norte", 104.5, 85);
$s1->guardar();
echo "Señal 1 guardada con ID: " . $s1->identificador . " | Prioritaria: " . ($s1->prioritaria ? "Sí" : "No") . "\n";

$s2 = new Senal("SIG-002", "Estación Sur", 98.2, 40);
$s2->guardar();
echo "Señal 2 guardada con ID: " . $s2->identificador . " | Prioritaria: " . ($s2->prioritaria ? "Sí" : "No") . "\n";


echo "\n=== 2. OBTENER TODAS (ORDENADAS POR INTENSIDAD) ===\n";
$todas = Senal::obtenerTodas();
foreach ($todas as $s) {
    echo "ID: {$s->identificador} | Código: {$s->codigo} | Intensidad: {$s->intensidad} | Estado: {$s->estado->value}\n";
}


echo "\n=== 3. BUSCAR POR ID Y MODIFICAR ===\n";
$buscada = Senal::buscar($s1->identificador);
if ($buscada !== null) {
    echo "Encontrada: {$buscada->codigo} en {$buscada->estacion}\n";
    $buscada->estacion = "Estación Norte Modificada";
    $buscada->guardar();
    echo "Estación actualizada a: {$buscada->estacion}\n";
}


echo "\n=== 4. CONFIRMAR Y DESCARTAR ===\n";
$confirmada = $s1->confirmar();
echo "Señal 1 confirmada: " . ($confirmada ? "OK" : "Fallo") . " | Nuevo estado: {$s1->estado->value} | Prioritaria ahora: " . ($s1->prioritaria ? "Sí" : "No") . "\n";

$confirmarDeNuevo = $s1->confirmar();
echo "Intentar confirmar de nuevo (debe dar Fallo): " . ($confirmarDeNuevo ? "OK" : "Fallo") . "\n";

$descartada = $s2->descartar();
echo "Señal 2 descartada: " . ($descartada ? "OK" : "Fallo") . " | Nuevo estado: {$s2->estado->value}\n";


echo "\n=== 5. OBTENER POR ESTADO (CONFIRMADA) ===\n";
$confirmadas = Senal::obtenerPorEstado(EstadoSeñal::CONFIRMADA);
foreach ($confirmadas as $c) {
    echo "Confirmada -> ID: {$c->identificador} | Código: {$c->codigo}\n";
}


echo "\n=== 6. PROBAR VALIDACIONES (PROPERTY HOOKS) ===\n";
try {
    $s1->frecuencia = -10;
} catch (InvalidArgumentException $e) {
    echo "Excepción capturada en frecuencia: " . $e->getMessage() . "\n";
}

try {
    $s1->intensidad = 150;
} catch (InvalidArgumentException $e) {
    echo "Excepción capturada en intensidad: " . $e->getMessage() . "\n";
}

echo "</pre>";
