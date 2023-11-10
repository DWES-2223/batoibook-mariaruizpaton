<?php
include 'load.php';
use BatBook\Book;
$book = new Book();
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $book = $book->findIdBook($id);
    $errores = [];
    if ($book){
        include './views/books/edit.view.php';
    } else {
        header("Location: errors/not-found.php");
    }
}