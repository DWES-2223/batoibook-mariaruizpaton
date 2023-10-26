<?php
include_once 'load.php';
session_destroy();
header('Location: newBook.php');