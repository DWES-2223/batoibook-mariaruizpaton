<?php

include 'load.php';

use BatBook\Book;
use Dompdf\Dompdf;

$course = new Book();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $course = $course->findIdBook($id);
    if ($course) {
        $pdf = new Dompdf();
        $pdf->loadHtml($course);
        $pdf->setPaper('A4', "landscape");
        $pdf->render();
        $pdf->stream();
    } else {
        header("Location: errors/not-found.php");
        exit();
    }
}