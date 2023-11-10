<?php
include_once 'load.php';
use BatBook\Book;

$book = new Book();
if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    $book = $book->findIdBook($id);

    if ($book) {
        $book->delete();
        header('Location: myBooks.php');
    } else {
        header("Location: errors/not-found.php");
    }
}
