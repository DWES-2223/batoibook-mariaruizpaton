<?php
namespace BatBook;
use BatBook\Exempcions\WeekPasswordException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


/**
 *
 */
class User {
    /**
     * @var string
     */
    public static $nameTable = 'users';
    /**
     * @var
     */
    private $id;

    /**
     * @param string $email
     * @param string $password
     * @param string $nick
     * @param string $token
     * @throws WeekPasswordException
     */
    public function __construct(
        private string $email='',
        private string $password='',
        private string $nick='',
        private string $token=''
    ) {
        if ($password !== '') {
            $this->setPassword($password);
        }
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
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @throws WeekPasswordException
     */
    public function setPassword($password): void
    {
        $this->validatePassword($password);
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param mixed $nick
     */
    public function setNick($nick): void
    {
        $this->nick = $nick;
    }

    /**
     * @return string
     */
    public function __toString() {
        return "<div class='user'>
                    <h3>Nick: {$this->getNick()}</h3>
                    <h6>Email: {$this->getEmail()}</h6>
                </div>";
    }

    /**
     * @throws WeekPasswordException
     */
    public function validatePassword($password) {
        if (strlen($password) < 8) {
            throw new WeekPasswordException("La contraseña debe tener al menos 8 caracteres.");
        }
        if (!preg_match('/[A-Z]/', $password)) {
            throw new WeekPasswordException("La contraseña debe contener al menos una letra mayúscula.");
        }
        if (!preg_match('/[a-z]/', $password)) {
            throw new WeekPasswordException("La contraseña debe contener al menos una letra minúscula.");
        }
        if (!preg_match('/[0-9]/', $password)) {
            throw new WeekPasswordException("La contraseña debe contener al menos un número.");
        }
        $this->password = $password;
    }

    /**
     * @param $email
     * @param $password
     * @return false|mixed
     */
    public static function login($email, $password){
        $log = new Logger('MyLogger');
        $log->pushHandler(new StreamHandler('logs/login.log'), Logger::DEBUG);
        $user = QueryBuilder::sql(User::class, ['email' => $email])[0];
        if (password_verify($password, $user->getPassword())){
            $log->info("Login correcto usuario: $user->nick");
            return $user;
        } else {
            $log->warning("Login incorrecto usuario: $user->nick");
        }
        return false;
    }

    /**
     * @return string|null
     */
    public function save()
    {
        $log = MyLog::getLogger("register");
        if ($id = QueryBuilder::insert(User::class, $this->toArray())){
            $log->info("Registro correcto usuario: $this->nick");
            return $id;
        }
        return null;
    }

    /**
     * @return void
     */
    public static function logout(){
        $log = MyLog::getLogger("logout");
        $user = QueryBuilder::find(User::class, $_SESSION['usuario']->id);
        $_SESSION['usuario'] = null;
        $log->info("Logout correcto usuario: $user->nick");

    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'nick' => $this->nick,
            'token' => $this->token
        ];
    }

    /**
     * @return string
     */
    public function toJSON(): string {
        $mapa = [];
        foreach ($this as $clave => $valor) {
            if ($clave !== 'password') {
                $valor = ($valor === '') ? null : $valor;
                $mapa[$clave] = $valor;
            }
        }

        return json_encode($mapa);
    }
}


