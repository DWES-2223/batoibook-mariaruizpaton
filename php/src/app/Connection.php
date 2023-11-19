<?php

namespace BatBook;

use PDO;
use PDOException;

include_once $_SERVER['DOCUMENT_ROOT'] . "/config/database.inc.php";

/**
 *
 */
class Connection {

    /**
     * @var PDO
     */
    private $connection;

    /**
     *
     */
    public function __construct() {
        try {
            $this->connection = new PDO(constDSN, constUSUARIO, constPASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO{
        return $this->connection;
    }

    /**
     * @return PDO
     */
    public static function get() : PDO{
        $conexion = new Connection();
        return $conexion->getConnection();
    }

    /**
     * @param $table
     * @param $data
     * @return void
     */
    public function insert($table, $data){

    }
}