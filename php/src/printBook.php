<?php

include 'load.php';

use BatBook\Book;
use Dompdf\Dompdf;

$book = new Book();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $book = $book->findIdBook($id);
    if ($book) {
        $pdf = new Dompdf();
        $pdf->loadHtml($book);
        $pdf->setPaper('A4', "landscape");
        $pdf->render();
        $pdf->stream();
    } else {
        header("Location: errors/not-found.php");
        exit();
    }
}