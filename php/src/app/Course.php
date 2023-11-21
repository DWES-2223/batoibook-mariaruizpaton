<?php

namespace BatBook;
use BatBook\Exempcions\InvalidFormatException;

/**
 *
 */
class Course
{
    static $nameTable = 'courses';
    /**
     * @var
     */
    private $cycle;
    /**
     * @var
     */
    private $idFamily;
    /**
     * @var
     */
    private $vliteral;
    /**
     * @var
     */
    private $cliteral;
    private $id;

    /**
     * @param $cycle
     * @param $idFamily
     * @param $vliteral
     * @param $cliteral
     */
    public function __construct($cycle='', $idFamily=0, $vliteral='', $cliteral='')
    {
        $this->cycle = $cycle;
        $this->idFamily = $idFamily;
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

    /**
     * @return mixed
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param mixed $cycle
     */
    public function setCycle($cycle): void
    {
        $this->cycle = $cycle;
    }

    /**
     * @return mixed
     */
    public function getIdFamily()
    {
        return $this->idFamily;
    }

    /**
     * @param mixed $idFamily
     */
    public function setIdFamily($idFamily): void
    {
        $this->idFamily = $idFamily;
    }

    /**
     * @return mixed
     */
    public function getVliteral()
    {
        return $this->vliteral;
    }

    /**
     * @param mixed $vliteral
     */
    public function setVliteral($vliteral): void
    {
        $this->vliteral = $vliteral;
    }

    /**
     * @return mixed
     */
    public function getCliteral()
    {
        return $this->cliteral;
    }

    /**
     * @param mixed $cliteral
     */
    public function setCliteral($cliteral): void
    {
        $this->cliteral = $cliteral;
    }

    public function getFamilyString($id){
        $family = Family::getFamilies()[intval($id)];
        return $family->getCliteral();
    }

    /**
     * @return string
     */
    public function toJSON(): string
    {
        $mapa = [];
        foreach ($this as $clave => $valor) {
            $mapa[$clave] = $valor;
        }
        return json_encode($mapa);
    }

    /**
     * @param $filename
     * @return array
     */
    public static function loadCoursesFromFile($filename)
    {
        $courses = [];
        if ($fp = fopen($filename, "r")) {
            while (($data = fgetcsv($fp, 1000, ',')) !== false) {
                try {
                    if (count($data) !== 5) {
                        throw new InvalidFormatException('Dada de línea imválida' . implode(", ", $data));
                    }
                    $courses[$data[0]] = new Course($data[1], $data[2], $data[3], $data[4]);
                } catch (InvalidFormatException $e) {
                    echo "Error " . $e->getMessage() . "\n";
                }
            }
        }
        fclose($fp);
        return $courses;
    }

    public static function find(){
        return QueryBuilder::sql(Course::class);
    }

    public function findById($id){
        return QueryBuilder::find(Course::class, $id);
    }

    public function update (){
        return QueryBuilder::update(Course::class,$this->toArray(), $this->id);
    }

    public function toArray(){
        return [
            'cycle' => $this->cycle,
            'idFamily' => $this->idFamily,
            'vliteral' => $this->vliteral,
            'cliteral' => $this->cliteral
        ];
    }

    public function delete(){
        return QueryBuilder::delete(Course::class, $this->id);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "<div class='course'>
                    <h3>Cycle: {$this->getCycle()}</h3>
                    <h5>ID Family: {$this->getIdFamily()}</h5>
                    <h6>Vliteral: {$this->getVliteral()}</h6>
                    <h6>Cliteral: {$this->getCliteral()}</h6>
                </div>";
    }
}

