<?php
namespace BatBook;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class MyLog {

    public static function getLogger(string $canal = "acces") : LoggerInterface {
        $log = new Logger(ucfirst($canal)."Logger");
        $log->pushHandler(new StreamHandler("logs/".$canal.".log"));
        return $log;
    }
}