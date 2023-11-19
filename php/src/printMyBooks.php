<?php
include 'load.php';
use Dompdf\Dompdf;


$pdf = new Dompdf();
$html = loadView("");
$pdf->loadHtml($book);
$pdf->setPaper('A4', "landscape");
$pdf->render();
$pdf->stream();