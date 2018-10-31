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
    private $entidade;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $ler;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $gravar;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $modificar;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $excluir;

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
    public function getEntidade(): string
    {
        return $this->entidade;
    }

    /**
     * @param string $entidade
     */
    public function setEntidade(string $entidade)
    {
        $this->entidade = $entidade;
    }

    /**
     * @return bool
     */
    public function isLer(): bool
    {
        return $this->ler;
    }

    /**
     * @param bool $ler
     */
    public function setLer(bool $ler)
    {
        $this->ler = $ler;
    }

    /**
     * @return bool
     */
    public function isGravar(): bool
    {
        return $this->gravar;
    }

    /**
     * @param bool $gravar
     */
    public function setGravar(bool $gravar)
    {
        $this->gravar = $gravar;
    }

    /**
     * @return bool
     */
    public function isModificar(): bool
    {
        return $this->modificar;
    }

    /**
     * @param bool $modificar
     */
    public function setModificar(bool $modificar)
    {
        $this->modificar = $modificar;
    }

    /**
     * @return bool
     */
    public function isExcluir(): bool
    {
        return $this->excluir;
    }

    /**
     * @param bool $excluir
     */
    public function setExcluir(bool $excluir)
    {
        $this->excluir = $excluir;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}

?>