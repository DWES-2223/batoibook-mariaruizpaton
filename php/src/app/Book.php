<?php

namespace BatBook;
use PDOException;

class Book
{
    private $idUser;
    private $idModule;
    private $publisher;
    private $price;
    private $pages;
    private $status;
    private $photo;
    private $comments;
    private $soldDate;

    /**
     * @param $idUser
     * @param $idModule
     * @param $publisher
     * @param $price
     * @param $pages
     * @param $status
     * @param $photo
     * @param $comments
     * @param $soldDate
     */
    public function __construct($idUser, $idModule, $publisher, $price, $pages, $status, $photo, $comments)
    {
        $this->idUser = $idUser;
        $this->idModule = $idModule;
        $this->publisher = $publisher;
        $this->price = $price;
        $this->pages = $pages;
        $this->status = $status;
        $this->photo = $photo;
        $this->comments = $comments;
        $this->soldDate = '';
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdModule()
    {
        return $this->idModule;
    }

    /**
     * @param mixed $idModule
     */
    public function setIdModule($idModule): void
    {
        $this->idModule = $idModule;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     */
    public function setPages($pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getSoldDate()
    {
        return $this->soldDate;
    }

    /**
     * @param mixed $soldDate
     */
    public function markAsSold($soldDate): void
    {
        $this->soldDate = $soldDate;
        $this->status = 'sold';
    }

    public function toJSON(): string {
        $mapa = [];
        foreach ($this as $clave => $valor) {
            if ($valor == ''){
                $valor = null;
            }
            $mapa[$clave] = $valor;
        }
        return json_encode($mapa);
    }

    public function save(){
        try {
            $conecction = new Connection();
            $conexion = $conecction->getConnection();
            $sql = 'INSERT INTO books (idUser, idModule, publisher, price, pages, status, photo, comments, soldDate) VALUES(:idUser, :idModule, :publisher, :price, :pages, :status, :photo, :comments, :soldDate)';

            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':idUser', $this->idUser);
            $sentencia->bindParam(':idModule', $this->idModule);
            $sentencia->bindParam(':publisher', $this->publisher);
            $sentencia->bindParam(':price', $this->price);
            $sentencia->bindParam(':pages', $this->pages);
            $sentencia->bindParam(':status', $this->status);
            $sentencia->bindParam(':photo', $this->photo);
            $sentencia->bindParam(':comments', $this->comments);
            $sentencia->bindParam(':soldDate', $this->soldDate);

            $sentencia->execute();
            $lastId = $conexion->lastInsertId();
            echo $lastId;
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }



    public function __toString(): string {
        return "<div class='book'>
                    <h6>Id User: {$this->idUser}</h6>
                    <h6>ID Module: {$this->idModule}</h6>
                    <h6>Publisher: {$this->publisher}</h6>
                    <h6>Price: {$this->price}</h6>
                    <h6>Pages: {$this->pages}</h6>
                    <h6>Status: {$this->status}</h6>
                    <h6>Photo: {$this->photo}</h6>
                    <h6>Comments: {$this->comments}</h6>
                    <h6>Sold Date: {$this->soldDate}</h6>
                </div>";
    }
}
