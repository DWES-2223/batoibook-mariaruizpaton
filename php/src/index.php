<?php
include_once ('Book.php');
include_once ('User.php');
include_once ('Course.php');
include_once ('Module.php');

$user = new User('user@example.com', 'StrongPassword1', 'UserNick');
$book = new Book(0, "0012", 'Publisher Name', 19.99, 300, 'Available', 'book.jpg', 'This is a great book');
$cycle = new Course('CycleName', 3, 'VliteralValue', 'CliteralValue');
$module = new Module('ModuleCode', 'CliteralValue', 'VliteralValue', 1);

$classes = [
    'book' => $book,
    'user' => $user,
    'course' => $cycle,
    'module' => $module,
];

foreach ($classes as $key => $instance) {
    echo "$key:\n";
    echo $instance . "\n";
    echo "----------------------------------------\n";
}

try {
    $courses = Course::loadCoursesFromFile("coursesbook.csv");
    $modules = Module::loadModulesFromFile("modulesbook.csv");
} catch (Exception $e){

}