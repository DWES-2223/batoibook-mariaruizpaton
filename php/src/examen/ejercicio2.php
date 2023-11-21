<?php

function generaMatriu($n, $m) {
    $matriu = [];
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $m; $j++) {
            $matriu[$i][$j] = rand(1, 500);
        }
    }
    return $matriu;
}

function printCela($num) {
    if ($num % 2 == 0) {
        echo '<td style="color: blue;">' . $num . '</td>';
    } else {
        echo '<td style="color: red;">' . $num . '</td>';
    }
}
$matriu = generaMatriu(10, 10);

echo '
<body>';
include '../header.php';
echo '<table border="2">';
$fila = 0;
for ($i = 0; $i < 10; $i++) {
    echo '<tr>';
    $sumaFila = 0;
    for ($j = 0; $j < 10; $j++) {
        printCela($matriu[$i][$j]);
        $sumaFila += $matriu[$i][$j];
        $fila += $sumaFila;
    }
    echo '<td>' . $sumaFila . '</td>';
    echo '</tr>';
}
echo '<tr>';
$colum = 0;
for ($j = 0; $j < 10; $j++) {
    $sumaColumna = 0;
    for ($i = 0; $i < 10; $i++) {
        $sumaColumna += $matriu[$i][$j];
        $colum += $sumaColumna;
    }
    echo '<td>' . $sumaColumna . '</td>';
}
$sumaTotal = $colum + $fila;
for ($j = 0; $j < 10; $j++) {
    for ($i = 0; $i < 10; $i++) {
        $sumaTotal += $matriu[$i][$j];
    }
}
echo '<td>' . $sumaTotal . '</td>';
echo '<td></td>';
echo '</tr>';
echo '</table>';

echo '</body>
</html>';
?>
