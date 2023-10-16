<?php
namespace BatBook;
class Module {
    private $code;
    private $cliteral;
    private $vliteral;
    private $idCycle;


    /**
     * @param $code
     * @param $cliteral
     * @param $vliteral
     * @param $idCycle
     */
    public function __construct($code, $cliteral, $vliteral, $idCycle)
    {
        $this->code = $code;
        $this->cliteral = $cliteral;
        $this->vliteral = $vliteral;
        $this->idCycle = $idCycle;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
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
    public function getIdCycle()
    {
        return $this->idCycle;
    }

    /**
     * @param mixed $idCycle
     */
    public function setIdCycle($idCycle): void
    {
        $this->idCycle = $idCycle;
    }

    public function toJSON(): string {
        $mapa = [];
        foreach ($this as $clave => $valor) {
            $mapa[$clave] = $valor;
        }
        return json_encode($mapa);
    }

    public static function loadModulesFromFile($filename): array
    {
        $modules = [];
        if ($fp = fopen($filename, "r")) {
            while (($data = fgetcsv($fp, 1000, ',')) !== false) {
                try {
                    if (count($data) !== 4) {
                        throw new InvalidFormatException('Dada de línea imválida' . implode(", ", $data));
                    }
                    $modules[$data[0]] = new Module($data[0], $data[1], $data[2], $data[3]);
                } catch (InvalidFormatException $e) {
                    echo "Error " . $e->getMessage() . "\n";
                }
            }
        }
        fclose($fp);
        return $modules;
    }

    public function __toString() {
        return "<div class='Module'><p><strong>Code:</strong> {$this->getCode()}</p><p><strong>Cliteral:</strong> {$this->getCliteral()}</p><p><strong>Vliteral:</strong> {$this->getVliteral()}</p><p><strong>ID Cycle:</strong> {$this->getIdCycle()}</p></div>";
    }
}

