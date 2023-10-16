<?php

include_once ("../Book.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;
$books = [
    1 => new Book(0, "0012", 'Publisher Name', 19.99, 300, 'Available', 'book.jpg', 'This is a great book')
];

if ($id === null) {
    throw new NotFoundException("no existe id");
} else {
    try {
        if (array_key_exists($id, $books)){
            echo json_encode($books[$id]->toJSON());
        } else {
            throw new NotFoundException("Id ${$id} no encontrado");
        }
    } catch (NotFoundException $e){
        echo "Error " . $e->getMessage() . "\n";
    }
}



class NotFoundException extends Exception {

}
