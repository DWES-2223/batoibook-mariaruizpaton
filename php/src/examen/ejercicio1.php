<?php
function esPrimo($numero): bool
{
    for ($i = 2; $i < $numero; $i++) {
        if (($numero % $i) == 0){
            return false;
        }
    }
    return true;
}
$numeros = [];
for ($i = 0; $i < 50; $i++) {
    $numeros[$i] = rand(100, 1000);
}
echo "Lista de numeros: " . implode(', ', $numeros) . "<br>";
$primos = array_filter($numeros, 'esPrimo');
echo "Lista de numeros primos: " . implode(', ', $primos) . "<br>";
echo "Cantidad total de números primos: " . count($primos);