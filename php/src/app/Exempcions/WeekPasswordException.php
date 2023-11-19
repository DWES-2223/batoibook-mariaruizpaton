<?php

namespace BatBook\Exempcions;
use Exception;

class WeekPasswordException extends MyExceptions
{
    public function __construct(
        $message = "Contrasenya dèbil",
        $code = 0,
        $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}