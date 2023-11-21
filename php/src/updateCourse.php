<?php
include 'load.php';
use BatBook\Course;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = intval($_POST['id']);
    $cycle = $_POST['cycle'];
    $idFamily = trim($_POST['idfamily']);
    $vliteral = trim($_POST['vliteral']);
    $cliteral = trim($_POST['cliteral']);

    if (empty($cycle)){
        $errores['cycle'] = 'Este campo debe estar relleno';
    }
    if (empty($vliteral)){
        $errores['vliteral'] = 'Este campo debe estar relleno';
    }
    if (empty($cliteral)){
        $errores['cliteral'] = 'Este campo debe estar relleno';
    }

    try {
        if (count($errores)){
            throw new Exception("Hay errores");
        }
    } catch (Exception $e){
        echo $e->getMessage();
        include './views/course/editCourse.view.php';
        exit();
    }

    $course =  new Course($cycle, $idFamily, $vliteral, $cliteral);
    $course->setId($id);
    if ($course->update()){
        header("Location: course.view.php");
        exit();
    }
}