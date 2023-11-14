<?php

namespace BatBook;
use PDO;
use PDOException;

/**
 *
 */
class Book
{
    /**
     * @var string
     */
    static $nameTable = 'books';
    /**
     * @var
     */
    private $id;

    /**
     * @param int $idUser
     * @param string $idModule
     * @param string $publisher
     * @param float $price
     * @param int $pages
     * @param string $status
     * @param string $photo
     * @param string $comments
     * @param string|null $soldDate
     */
    public function __construct(
        private int $idUser = 0,
        private string $idModule = '',
        private string $publisher ='',
        private float $price = 0,
        private int $pages = 0,
        private string $status = '',
        private string $photo = '',
        private string $comments = '',
        private ?string $soldDate = null
    ) {
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdModule()
    {
        return $this->idModule;
    }

    /**
     * @param mixed $idModule
     */
    public function setIdModule(string $idModule): void
    {
        $this->idModule = $idModule;
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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     */
    public function setPages(int $pages): void
    {
        $this->pages = $pages;
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
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return string|null
     */
    public function getSoldDate(): ?string
    {
        return $this->soldDate;
    }

    /**
     * @param mixed $soldDate
     */
    public function markAsSold(string $soldDate): void
    {
        $this->soldDate = $soldDate;
        $this->status = 'sold';
    }

    /**
     * @return string
     */
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

    /**
     * @return false|mixed|string
     */
    public function save(){
        $log = MyLog::getLogger("newBook");
        if ($this->id) {
            return QueryBuilder::update(Book::class,$this->toArray(), $this->id);
        } else {
            $id = QueryBuilder::insert(Book::class, $this->toArray());
            if ($id){
                $this->id = $id;
                $nick = $_SESSION['usuario']->getNick();
                $nomModul = $this->getModule($this->idModule);
                $log->info("Libro con id $this->id, modulo $nomModul insertado correctamente del usuario $nick");
            }
            return $id;
        }
    }

    /**
     * @return bool|null
     */
    public function delete(): ?bool
    {
        return QueryBuilder::delete(Book::class, $this->id);
    }

    /**
     * @return mixed
     */
    public function find(){
        return QueryBuilder::find(Book::class,$this->id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findIdBook(int $id) {
        return QueryBuilder::find(Book::class,$id);
    }


    /**
     * @param string $code
     * @return string
     */
    public function getModule(string $code) : string{
        $modul = Module::getModulesInArray()[$code];
        return $modul->getCliteral();
    }

    /**
     * @param int $idUser
     * @return array|false
     */
    public static function findByUserId(int $idUser){
        $values = ['idUser' => $idUser];
        return QueryBuilder::sql(Book::class, $values);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'idUser' => $this->idUser,
            'idModule' => $this->idModule,
            'publisher' => $this->publisher,
            'price' => $this->price,
            'pages' => $this->pages,
            'status' => $this->status,
            'photo' => $this->photo,
            'comments' => $this->comments,
            'soldDate' => $this->soldDate
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return "<div class='book'>
                    <h6>Id User: {$this->idUser}</h6>
                    <h6>ID Module: {$this->idModule}</h6>
                    <h6>Publisher: {$this->publisher}</h6>
                    <h6>Price: {$this->price}</h6>
                    <h6>Pages: {$this->pages}</h6>
                    <h6>Status: {$this->status}</h6>
                    <h6>Photo: {$this->photo}</h6>
                    <h6>Comments: {$this->comments}</h6>
                    <h6>Sold Date: {$this->soldDate}</h6>
                </div>";
    }
}
