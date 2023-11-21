<?php
namespace BatBook;

class Family{
    private $id;


    private $vliteral;

    private $cliteral;

    public static string $nameTable = 'families';

    public function __construct($vliteral='', $cliteral='')
    {
        $this->vliteral = $vliteral;
        $this->cliteral = $cliteral;
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

    public function getVliteral(): mixed
    {
        return $this->vliteral;
    }

    public function setVliteral(mixed $vliteral): void
    {
        $this->vliteral = $vliteral;
    }

    public function getCliteral(): mixed
    {
        return $this->cliteral;
    }

    public function setCliteral(mixed $cliteral): void
    {
        $this->cliteral = $cliteral;
    }

    public static function getFamilies(){
        $array = [];
        $family = QueryBuilder::sql(Family::class);
        foreach ($family as $item){
            $array[$item->getId()] = $item;
        }
        return $array;
    }
}