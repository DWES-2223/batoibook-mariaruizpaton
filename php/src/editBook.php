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
        echo 'El libro no existe';
        echo '<a href="myBooks.php">Volver a la página anterior</a>';
    }
}