<?php
include 'load.php';
use BatBook\Module;
use BatBook\Book;

$modulos = [];
$errores = [];
try {
    $modulos = Module::getModulesInArray();
} catch (Exception $e){
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $module = $_POST['module'];
    $publisher = trim($_POST['publisher']);
    $preu = trim($_POST['price']);
    $pagines = trim($_POST['pages']);
    $stat = $_POST['status'];
    $nombre = '';
    if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
            $nombre = $_FILES['photo']['name'];
    }
    $comments = trim($_POST['comments']??'');

    if (empty($publisher)){
        $errores['publisher'] = "Editorial es requerido";
    }
    if (!is_numeric($preu)){
        $errores['price'] = "El precio tiene que ser un número";
    }
    if (!is_numeric($pagines)){
        $errores['pages'] = "Las páginas tienen que ser un número";
    }
    if (!array_key_exists($stat, $status)){
        $errores['status'] = "Debe elegír un estado válido";
    }

    try {
        if (count($errores)){
            include_once 'header.php';
            throw new Exception("Hay errores");
        }
    } catch (Exception $e){
        echo $e->getMessage();
        include './views/books/new.php';
        exit();
    }

    $usuario = $_SESSION['usuario'];
    $book =  new Book($usuario->getId(), $module, $publisher, $preu, $pagines, $stat, $nombre, $comments);
    $book->save();
    echo $book;
}
include_once 'header.php';
include_once './views/books/new.php';
