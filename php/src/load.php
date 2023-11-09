<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/myHelpers/utils.php';
session_start();
$user = $_SESSION['usuario'] ?? null;
$status = ['new' => 'Nuevo', 'good' => 'Bueno', 'used' => 'Usado', 'bad' => 'Malo'];
