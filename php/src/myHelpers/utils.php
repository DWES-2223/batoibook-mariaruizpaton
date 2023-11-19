<?php
function printError($error, $field) : string {
    if (isset($error[$field])) {
        return '<span class="error">' . $error[$field] . '</span>';
    }
    return '';
}

function loadView($view, $data = [])
{
    extract($data);
    ob_clean();
    include_once $_SERVER['DOCUMENT_ROOT']."view/$view.php";
    $html = ob_get_clean();
    return $html;
}