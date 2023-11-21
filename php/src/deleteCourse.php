<?php
include_once 'load.php';
use BatBook\Course;

$course = new Course();
if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    $course = $course->findById($id);
    if ($course) {
        $course->delete();
        header('Location: course.view.php');
    } else {
        echo 'No se encontró el ciclo';
    }
}
