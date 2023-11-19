<?php

namespace BatBook\Exempcions;
use Exception;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MyExceptions extends Exception
{
    public function __construct(string $msg, $code, $previus) {
        $canal = 'error';
        $log = new Logger(ucfirst($canal)."Logger");
        $file = $_SERVER['DOCUMENT_ROOT']."/logs/".$canal.".log";
        $log->pushHandler(new StreamHandler($file, Logger::DEBUG));
        $log->pushHandler(new FirePHPHandler(Logger::DEBUG));
        $log->warning($msg);
        parent::__construct($msg, $code, $previus);
    }
}
