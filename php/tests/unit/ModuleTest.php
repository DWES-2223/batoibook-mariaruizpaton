<?php

class ModuleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        require_once 'src/Module.php';
    }

    protected function _after()
    {
    }

    // tests
    public function testCreation()
    {
        $module = new Module('Code1', 'Cliteral1', 'Vliteral1', 'Cycle1');
        $this->assertInstanceOf(Module::class, $module);
    }

    public function testGetters()
    {
        $module = new Module('Code1', 'Cliteral1', 'Vliteral1', 'Cycle1');
        $this->assertEquals('Code1', $module->getCode());
        $this->assertEquals('Cliteral1', $module->getCliteral());
        $this->assertEquals('Vliteral1', $module->getVliteral());
        $this->assertEquals('Cycle1', $module->getIdCycle());
    }

    public function testSetters()
    {
        $module = new Module('Code1', 'Cliteral1', 'Vliteral1', 'Cycle1');
        $module->setCode('NewCode');
        $module->setCliteral('NewCliteral');
        $module->setVliteral('NewVliteral');
        $module->setIdCycle('NewCycle');

        $this->assertEquals('NewCode', $module->getCode());
        $this->assertEquals('NewCliteral', $module->getCliteral());
        $this->assertEquals('NewVliteral', $module->getVliteral());
        $this->assertEquals('NewCycle', $module->getIdCycle());
    }

    public function testToString()
    {
        $module = new Module('Code1', 'Cliteral1', 'Vliteral1', 'Cycle1');
        $expectedString = "<div class='Module'><p><strong>Code:</strong> Code1</p>" .
            "<p><strong>Cliteral:</strong> Cliteral1</p>" .
            "<p><strong>Vliteral:</strong> Vliteral1</p>" .
            "<p><strong>ID Cycle:</strong> Cycle1</p></div>";
        $this->assertEquals($expectedString, $module->__toString());
    }

    public function testToJson()
    {
        $module = new Module('Code1', 'Cliteral1', 'Vliteral1', 'Cycle1');
        $expectedJson = json_encode([
            'code' => 'Code1',
            'cliteral' => 'Cliteral1',
            'vliteral' => 'Vliteral1',
            'idCycle' => 'Cycle1'
        ]);
        $this->assertEquals($expectedJson, $module->toJson());
    }

    public function testLoadModulesFromFile()
    {
        $filename = 'src/modulesbook.csv'; // Especifica el camí correcte al teu fitxer CSV de prova
        $modules = Module::loadModulesFromFile($filename);
        $this->assertIsArray($modules);
        $this->assertNotEmpty($modules);
        $this->assertContainsOnlyInstancesOf(Module::class, $modules);
        $this->assertEquals(264, count($modules));
    }
}
