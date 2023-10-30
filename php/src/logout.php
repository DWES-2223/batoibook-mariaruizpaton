<?php
include_once 'load.php';
session_destroy();
header('Location: index.php');