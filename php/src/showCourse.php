<?php
include 'load.php';
use BatBook\Course;
$course = new Course();
if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    $course = $course->findById($id);
    if ($course) {
        include './views/course/showCourse.view.php';
    }
}
