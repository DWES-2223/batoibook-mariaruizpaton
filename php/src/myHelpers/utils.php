<?php
function printError($error, $field) : string {
    if (isset($error[$field])) {
        return '<span class="error">' . $error[$field] . '</span>';
    }
    return '';
}