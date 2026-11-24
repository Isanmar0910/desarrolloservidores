<?php

require_once 'clases/medicion.php';

$repositorio = new MedicionRepository();

echo "<h2>obtenerTodas</h2>";
echo "<pre>";
print_r($repositorio->obtenerTodas());
echo "</pre>";

echo "<h2>buscarPorIdentificador(1)</h2>";
echo "<pre>";
print_r($repositorio->buscarPorIdentificador(1));
echo "</pre>";

echo "<h2>buscarPorIdentificador(999) (no existe)</h2>";
echo "<pre>";
var_dump($repositorio->buscarPorIdentificador(999));
echo "</pre>";

echo "<h2>buscarPorTipo(temperatura)</h2>";
echo "<pre>";
print_r($repositorio->buscarPorTipo(TipoMedicion::temperatura));
echo "</pre>";