<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/myHelpers/utils.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

use BatBook\Book;
use BatBook\QueryBuilder;
use BatBook\Sales;
use BatBook\User;

$user = new User();
$book = new Book();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idBook = $_POST['idBook'];
    $idUser = $_POST['idUser'];

    $user = QueryBuilder::find(User::class, $idUser);
    $libro = $book->findIdBook($idBook);
    if (empty($user) && empty($book)) {
        echo "Usuario o libro no encontrado";
        exit();
    }
    $sale = new Sales($idBook, $idUser);
    $sale->setId($sale->save());
    $libro->markAsSold(date('d.m.y'));
    $libro->save();
    echo $sale->toJson();
    echo $libro->toJson();

}
