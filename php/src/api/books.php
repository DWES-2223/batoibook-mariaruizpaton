<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/myHelpers/utils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

use BatBook\Book;
use BatBook\Exempcions\NotFoundException;
use BatBook\QueryBuilder;

$books = QueryBuilder::sql(Book::class);
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $book = new Book();
        $book = $book->findIdBook($id);
        if ($book != null) {
            echo $book->toJson();
        } else {
            throw new NotFoundException("Id $id no encontrado");
        }
    } catch (NotFoundException $e) {
        echo "Error " . $e->getMessage() . "\n";
    }
} else {
    foreach ($books as $libro) {
        echo $libro->toJson();
    }
}


