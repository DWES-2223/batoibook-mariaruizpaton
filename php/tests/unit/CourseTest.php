<?php

class CourseTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        require_once 'src/Course.php';
    }

    protected function _after()
    {
    }

    // tests
    public function testCreation()
    {
        $course = new Course('Cycle1', 1, 'Vliteral1', 'Cliteral1');
        $this->assertInstanceOf(Course::class, $course);
    }

    public function testGetters()
    {
        $course = new Course('Cycle1', 1, 'Vliteral1', 'Cliteral1');
        $this->assertEquals('Cycle1', $course->getCycle());
        $this->assertEquals(1, $course->getIdFamily());
        $this->assertEquals('Vliteral1', $course->getVliteral());
        $this->assertEquals('Cliteral1', $course->getCliteral());
    }

    public function testSetters()
    {
        $course = new Course('Cycle1', 1, 'Vliteral1', 'Cliteral1');
        $course->setCycle('NewCycle');
        $course->setIdFamily(2);
        $course->setVliteral('NewVliteral');
        $course->setCliteral('NewCliteral');

        $this->assertEquals('NewCycle', $course->getCycle());
        $this->assertEquals(2, $course->getIdFamily());
        $this->assertEquals('NewVliteral', $course->getVliteral());
        $this->assertEquals('NewCliteral', $course->getCliteral());
    }

    public function testToString()
    {
        $course = new Course('Cycle1', 1, 'Vliteral1', 'Cliteral1');
        $expectedString = "<div clas='course'>
                    <h3>Cycle: Cycle1</h3>
                    <h5>ID Family: 1<h5>
                    <h6>Vliteral: Vliteral1</h6>
                    <h6>Cliteral: Cliteral1</h6>
                </div>";
        $this->assertEquals($expectedString, $course->__toString());
    }

    public function testToJson()
    {
        $course = new Course('Cycle1', 1, 'Vliteral1', 'Cliteral1');
        $expectedJson = json_encode([
            'cycle' => 'Cycle1',
            'idFamily' => 1,
            'vliteral' => 'Vliteral1',
            'cliteral' => 'Cliteral1'
        ]);
        $this->assertEquals($expectedJson, $course->toJson());
    }

    public function testLoadModulesFromFile()
    {
        $filename = 'src/coursesbook.csv';
        $courses = Course::loadCoursesFromFile($filename);
        $this->assertIsArray($courses);
        $this->assertNotEmpty($courses);
        $this->assertContainsOnlyInstancesOf(Course::class, $courses);
        $this->assertEquals(26, count($courses));
    }

    public function testInvalidFormatExceptionOnLoad()
    {
        $filename = 'src/coursebook.csv';

        // Assegura't que el fitxer existisca i tinga un format incorrecte que causarà l'excepció esperada

        $this->expectException(Codeception\Exception\Warning::class); // Canvia aquesta línia si utilitzes una excepció diferent

        $courses = Course::loadCoursesFromFile($filename);
    }

}
