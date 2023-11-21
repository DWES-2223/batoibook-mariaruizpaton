<?php

use BatBook\Course;

include 'load.php';

$course = new Course();
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $course = $course->findById($id);
    $errores = [];
    if ($course){
        include './views/course/editCourse.view.php';
    }
}
