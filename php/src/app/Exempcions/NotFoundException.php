<?php
namespace BatBook\Exempcions;
use BatBook\Exempcions\MyExceptions;

class NotFoundException extends MyExceptions
{
    public function __construct($message = "Recurs no trobat", $code = 404, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
