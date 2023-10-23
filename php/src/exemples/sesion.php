<?php
session_start();
$i = isset($_SESSION['visits'])?$_SESSION['visits']:1;
echo "He visitado esta pagina " . $i . " veces";
$i++;