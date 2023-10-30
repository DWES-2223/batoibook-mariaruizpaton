<?php
include 'autoload.php';
include 'load.php';
include './myHelpers/utils.php';
use BatBook\Module;

$modulos = [];
$stats = ['nuevo', 'bueno', 'usado', 'malo', 'digital'];
$errores = [];
try {
    $modulos = Module::loadModulesFromFile("./files/modulesbook.csv");
} catch (Exception $e){
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $module = $_POST['module'];
    $publisher = trim($_POST['publisher']);
    $preu = trim($_POST['price']);
    $pagines = trim($_POST['pages']);
    $status = $_POST['status'];
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
    if (!in_array($status,$stats)){
        $errores['status'] = "Debe elegír un estado válido";
    }

    try {
        if (count($errores)){
            throw new Exception("Hay errores");
        }
    } catch (Exception $e){
        echo $e->getMessage();
        include './views/books/new.php';
        exit();
    }

    $user = $_SESSION['usuario'];
    $idUser = null;
    foreach ($users as $key => $item){
        if ($item->getNick() == $user){
            $idUser = $key+1;
        }
    }
    $book =  new \BatBook\Book($idUser, $module, $publisher, $preu, $pagines, $status, $nombre, $comments);
    echo $book;
    $books[] = $book;
    $_SESSION['books'] = serialize($books);

}
include_once './views/books/new.php';
