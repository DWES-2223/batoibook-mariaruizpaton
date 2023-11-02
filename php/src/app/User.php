<?php
namespace BatBook;
use BatBook\Exempcions\WeekPasswordException;

class User {
    private $email;
    private $password;
    private $nick;

    /**
     * @param $email
     * @param $password
     * @param $nick
     * @throws WeekPasswordException
     */
    public function __construct($email, $password, $nick)
    {
        $this->email = $email;
        $this->nick = $nick;
        $this->setPassword($password);
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

    public static function login($email, $password){
        $user = QueryBuilder::sql('users', ['email' => $email])[0];
        if (password_verify($password, $user->getPassword())){
            return $user;
        }
        return false;
    }

    public function save()
    {
        return QueryBuilder::insert(User::class, $this->toArray());
    }

    private function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'nick' => $this->nick
        ];
    }
}


