<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Acesso
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="acesso")
 */
class Acesso {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $rota;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $GET;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $POST;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $PUT;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $DELETE;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRota(): string
    {
        return $this->rota;
    }

    /**
     * @param string $entidade
     */
    public function setRota(string $rota)
    {
        $this->rota = $rota;
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->GET;
    }

    /**
     * @param bool $ler
     */
    public function setGet(bool $GET)
    {
        $this->GET = $GET;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->POST;
    }

    /**
     * @param bool $gravar
     */
    public function setPosta(bool $POST)
    {
        $this->POST = $POST;
    }

    /**
     * @return bool
     */
    public function isPut(): bool
    {
        return $this->PUT;
    }

    /**
     * @param bool $modificar
     */
    public function setPut(bool $PUT)
    {
        $this->PUT = $PUT;
    }

    /**
     * @return bool
     */
    public function isDelete(): bool
    {
        return $this->DELETE;
    }

    /**
     * @param bool $excluir
     */
    public function setDelete(bool $DELETE)
    {
        $this->DELETE = $DELETE;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}

?>