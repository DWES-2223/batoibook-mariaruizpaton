<?php
use BatBook\Course;
use BatBook\Module;
include 'autoload.php';
session_start();

$modulos = isset($_SESSION['modules'])?unserialize($_SESSION['modules']) : Module::loadModulesFromFile("./files/modulesbook.csv");
$courses = isset($_SESSION["courses"])?unserialize($_SESSION["courses"]) : Course::loadCoursesFromFile("./files/coursesbook.csv");
$users = isset($_SESSION['users'])?unserialize($_SESSION['users']) : [];
$books = isset($_SESSION['books'])?unserialize($_SESSION['books']) : [];
$statuses = isset($_SESSION['statuses'])?unserialize($_SESSION['statuses']) : ['nuevo', 'bueno', 'usado', 'malo', 'digital'];


if (!isset($_SESSION['modules'])){
    $_SESSION['modules'] = serialize($modulos);
}
if (!isset($_SESSION['courses'])){
    $_SESSION['courses'] = serialize($courses);
}
if (!isset($_SESSION['users'])){
    $_SESSION['users'] = serialize($users);
}
if (!isset($_SESSION['books'])){
    $_SESSION['books'] = serialize($books);
}
if (!isset($_SESSION['statuses'])){
    $_SESSION['statuses'] = serialize($statuses);
}