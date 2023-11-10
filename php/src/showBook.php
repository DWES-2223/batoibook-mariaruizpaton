<?php
include 'load.php';
use BatBook\Book;
$book = new Book();
if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    $book = $book->findIdBook($id);

    if ($book) {
        include './views/books/show.view.php';
    } else {
        header("Location: errors/not-found.php");
    }
}
