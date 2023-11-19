<?php

namespace BatBook\Exempcions;
use Exception;

class InvalidFormatException extends MyExceptions
{

    public function __construct($message = "Format Invàlid", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}