<?php


class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        require_once 'src/User.php';
    }

    protected function _after()
    {
    }

    // tests
    public function testCreationWithValidPassword()
    {
        $user = new User('test@example.com', 'Password1', 'NickName');
        $this->assertInstanceOf(User::class, $user);
    }

    public function testPasswordComplexity()
    {
        $this->expectException(WeekPasswordException::class);

        // Construint un objecte User amb una contrasenya dèbil hauria de llançar una excepció
        new User('test@example.com', 'password', 'NickName');
    }

    public function testGetters()
    {
        $user = new User('test@example.com', 'Password1', 'NickName');
        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertEquals('Password1', $user->getPassword()); // En un cas real, potser no hauries de tenir un getter per a la contrasenya
        $this->assertEquals('NickName', $user->getNick());
    }

    public function testSetters()
    {
        $user = new User('test@example.com', 'Password1', 'NickName');
        $user->setEmail('new@example.com');
        $user->setPassword('NewPassword1');
        $user->setNick('NewNick');

        $this->assertEquals('new@example.com', $user->getEmail());
        $this->assertEquals('NewPassword1', $user->getPassword()); // De nou, considera no tenir un getter per a contrasenyes
        $this->assertEquals('NewNick', $user->getNick());
    }

    public function testToString()
    {
        $user = new User('test@example.com', 'Password1', 'NickName');
        $expectedString = "<div class='user'>
                    <h3>Nick: NickName</h3>
                    <h6>Email: test@example.com</h6>
                </div>";
        $this->assertEquals($expectedString, $user->__toString());
    }
}
