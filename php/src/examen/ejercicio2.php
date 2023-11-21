<?php
session_start();

if (!isset($_SESSION['visitas'])){
    $_SESSION['visitas'] = 1;
    echo "Bienvenido por primera vez";
} else {
    $_SESSION['visitas']++;
    echo "Bienvenido, ha visto la pagina " . $_SESSION['visitas'];
}