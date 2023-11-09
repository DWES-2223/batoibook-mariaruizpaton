<?php

namespace BatBook;
use PDO;

class QueryBuilder{
    // Aquesta funció serveix per a construir i executar consultes SQL de tipus SELECT.
    // Es pot filtrar per valors, limitar la quantitat de resultats i establir un offset.
    public static function sql($class, $values=null, $limit = null, $offset = null)
    {
        // Obté el nom de la taula a partir de la propietat estàtica $nameTable de la classe passada com argument.
        $table = $class::$nameTable;

        // Obté una connexió a la base de dades.
        $conn = Connection::get();

        // Construeix la consulta SQL bàsica.
        $sql = "SELECT * FROM $table";

        // Afegeix condicions WHERE si es proporcionen valors per a filtrar.
        if ($values) {
            $sql .= " WHERE ";
            foreach (array_keys($values) as $key => $id) {
                if ($key != 0) {
                    $sql .= " AND $id=:$id";
                } else {
                    $sql .= "$id=:$id";
                }
            }
        }

        // Afegeix les clàusules LIMIT i OFFSET si són necessàries.
        if (isset($limit) && isset($offset)) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        // Prepara la sentència SQL.
        $sentence = $conn->prepare($sql);

        // Enllaça els valors a la sentència.
        foreach ($values??[] as $key => $value) {
            $sentence->bindValue(":$key", $value);
        }

        // Estableix el mode de recuperació a objectes de la classe especificada.
        $sentence -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $class);

        // Executa la consulta.
        $sentence -> execute();

        // Retorna tots els resultats obtinguts.
        return  $sentence->fetchAll();
    }

    // Aquesta funció serveix per a trobar una fila en una taula basant-se en el seu ID.
    public static function find($class, $id)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "SELECT * FROM $table WHERE id = :id";
        $sentence = $conn->prepare($sql);
        $sentence->bindValue(':id', $id);
        $sentence->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        $sentence->execute();
        return $sentence->fetch();
    }

    // Aquesta funció serveix per a insertar una fila en una taula.
    public static function insert($class, $values)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "INSERT INTO $table (";
        foreach (array_keys($values) as $key => $id) {
            if ($key != 0) {
                $sql .= ','.$id;
            } else {
                $sql .= $id;
            }
        }
        $sql .= ") VALUES (";
        foreach (array_keys($values) as $key => $id) {
            if ($key != 0) {
                $sql .= ',:'.$id;
            } else {
                $sql .= ':'.$id;
            }
        }
        $sql .= ")";
        $sentence = $conn->prepare($sql);
        foreach ($values as $key => $value) {
            $sentence->bindValue(":$key", $value);
        }
        $sentence -> execute();
        return $conn->lastInsertId();
    }

    // Aquesta funció serveix per a actualitzar una fila en una taula.
    public static function update($class, $values, $id)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "UPDATE $table SET ";
        foreach (array_keys($values) as $key => $value) {
            if ($key != 0) {
                $sql .= ','.$value.'=:'.$value;
            } else {
                $sql .= $value.'=:'.$value;
            }
        }
        $sql .= " WHERE id=:id";
        $sentence = $conn->prepare($sql);
        foreach ($values as $key => $value) {
            $sentence->bindValue(":$key", $value);

        }
        $sentence->bindValue(":id", $id);
        $sentence -> execute();
        return $id;
    }

    // Aquesta funció serveix per a eliminar una fila en una taula basant-se en el seu ID.
    public static function delete($class, $id)
    {
            $table = $class::$nameTable;
            $conn = Connection::get();
            $sql = "DELETE FROM $table WHERE id = :id";
            $sentence = $conn->prepare($sql);

            $sentence->bindParam(':id', $id);
            $sentence->execute();
            return $sentence->rowCount() > 0;

    }
}
