<?php

class BookTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        require_once 'src/Book.php';
    }

    protected function _after()
    {
    }

    // tests
    public function testCreation()
    {
        $book = new Book(1, 'MOD101', 'Publisher', 29.99, 200, 'Available', 'image.jpg', 'Great book!');
        $this->assertInstanceOf(Book::class, $book);
    }

    public function testGetters()
    {
        $book = new Book(1, 'MOD101', 'Publisher', 29.99, 200, 'Available', 'image.jpg', 'Great book!');
        $this->assertEquals(1, $book->getIdUser());
        $this->assertEquals('MOD101', $book->getIdModule());
        $this->assertEquals('Publisher', $book->getPublisher());
        // ... altres getters ...
    }

    public function testSetters()
    {
        $book = new Book(1, 'MOD101', 'Publisher', 29.99, 200, 'Available', 'image.jpg', 'Great book!');
        $book->setIdUser(2);
        $this->assertEquals(2, $book->getIdUser());
        $book->setIdModule('MOD102');
        $this->assertEquals('MOD102', $book->getIdModule());
        $book->setPublisher('New Publisher');
        $this->assertEquals('New Publisher', $book->getPublisher());
        // ... altres setters ...
    }

    public function testMarkAsSold()
    {
        $book = new Book(1, 'MOD101', 'Publisher', 29.99, 200, 'Available', 'image.jpg', 'Great book!');
        $book->markAsSold('2023-10-05');
        $this->assertEquals('sold', $book->getStatus());
        $this->assertEquals('2023-10-05', $book->getSoldDate());
    }

    public function testToString()
    {
        $book = new Book(1, 'MOD101', 'Publisher', 29.99, 200, 'Available', 'image.jpg', 'Great book!');
        $expectedString = "<div class='book'>
                    <h6>Id User: 1</h6>
                    <h6>ID Module: MOD101</h6>
                    <h6>Publisher: Publisher</h6>
                    <h6>Price: 29.99</h6>
                    <h6>Pages: 200</h6>
                    <h6>Status: Available</h6>
                    <h6>Photo: image.jpg</h6>
                    <h6>Comments: Great book!</h6>
                    <h6>Sold Date: </h6>
                </div>";
        $this->assertEquals($expectedString, $book->__toString());
    }

    public function testToJson()
    {
        $book = new Book(1, 'MOD101', 'Publisher', 29.99, 200, 'Available', 'image.jpg', 'Great book!');
        $expectedJson = json_encode([
            'idUser' => 1,
            'idModule' => 'MOD101',
            'publisher' => 'Publisher',
            'price' => 29.99,
            'pages' => 200,
            'status' => 'Available',
            'photo' => 'image.jpg',
            'comments' => 'Great book!',
            'soldDate' => null
        ]);
        $this->assertEquals($expectedJson, $book->toJson());
    }
}
