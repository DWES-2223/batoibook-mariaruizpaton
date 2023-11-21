<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/myHelpers/utils.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';
session_start();
$user = $_SESSION['usuario'] ?? null;
$visita = $_SESSION['visita'] ?? null;
$status = ['new' => 'Nuevo', 'good' => 'Bueno', 'used' => 'Usado', 'bad' => 'Malo'];
