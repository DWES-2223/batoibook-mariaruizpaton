<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/myHelpers/utils.php';
use BatBook\Book;
use BatBook\QueryBuilder;


if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    $books = QueryBuilder::sql(Book::class);
    if ($id === null) {
        throw new NotFoundException("no existe id");
    } else {

        try {
            $book = new Book();
            $book = $book->findIdBook($id);
            if ($book != null){
                echo $book->toJson();
            } else {
                throw new NotFoundException("Id $id no encontrado");
            }
        } catch (NotFoundException $e){
            echo "Error " . $e->getMessage() . "\n";
        }
    }
}


class NotFoundException extends Exception {

}