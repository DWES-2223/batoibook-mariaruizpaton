<?php
include 'load.php';
use Dompdf\Dompdf;


$pdf = new Dompdf();
$html = loadView("");
$pdf->loadHtml($course);
$pdf->setPaper('A4', "landscape");
$pdf->render();
$pdf->stream();