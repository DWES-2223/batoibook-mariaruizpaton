<?php
function printError($error, $field) : string {
    if (isset($error[$field])) {
        return '<span class="error">' . $error[$field] . '</span>';
    }
    return '';
}
spl_autoload_register( function( $nombreClase ) {
    $ruta = $nombreClase.'.php';
    $ruta = str_replace("BatBook", "app", $ruta); // Sustituimos las barras
    $ruta = str_replace("\\", "/", $ruta); // Sustituimos las barras
    include_once $_SERVER['DOCUMENT_ROOT'].'/'.$ruta;
} );