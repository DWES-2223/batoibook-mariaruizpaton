<?php

namespace BatBook;
class Sales
{
    private $idBook;
    private $idUser;
    private $id;
    private $status;
    static $nameTable = 'sales';

    /**
     * @param $idBook
     * @param $idUser
     */
    public function __construct($idBook = '', $idUser = '')
    {
        $this->idBook = $idBook;
        $this->idUser = $idUser;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getIdBook()
    {
        return QueryBuilder::find(Book::class, $this->idBook);
    }

    /**
     * @param mixed $idBook
     */
    public function setIdBook($idBook): void
    {
        $this->idBook = $idBook;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return QueryBuilder::find(User::class, $this->idUser);
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }


    public function save()
    {
        return QueryBuilder::insert(Sales::class, $this->toArray());
    }

    public function toArray(): array
    {
        return [
            'idBook' => $this->idBook,
            'idUser' => $this->idUser
        ];
    }

    public function delete()
    {
        return QueryBuilder::delete(Sales::class, $this->id);
    }

    public static function getSales($idUser)
    {
        $values = ['idUser' => $idUser];
        $array = [];
        $sales = QueryBuilder::sql(Sales::class, $values);
        foreach ($sales as $item){
            $array[$item->getId()] = $item;
        }
        return $array;
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
}
