<?php
class WeekPasswordException extends Exception {
    public function __construct($message = "La contraseña no cumple los requisitos de seguridad.") {
        parent::__construct($message);
    }
}