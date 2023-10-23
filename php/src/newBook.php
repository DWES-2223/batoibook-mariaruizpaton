<?php
include ("autoload.php");
use BatBook\Module;

$modulos = [];
$stats = ['Nuevo', 'Bueno', 'Usado', 'Malo', 'Digital'];
try {
    $modulos = Module::loadModulesFromFile("files/modulesbook.csv");
} catch (Exception $e){
    echo $e->getMessage();
}

function printError($error, $field) : string {
    if (isset($error[$field])) {
        return '<span class="error">' . $error[$field] . '</span>';
    }
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

} else {
    include_once 'newBookView.php';
}