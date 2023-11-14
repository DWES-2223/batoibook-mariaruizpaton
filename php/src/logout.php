<?php
use BatBook\User;
include_once 'load.php';
User::logout();
header('Location: index.php');