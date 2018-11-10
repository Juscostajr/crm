<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perfil")
 */
class Perfil
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Acesso", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="perfil_acesso",
     *      joinColumns={@ORM\JoinColumn(name="perfil", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="acesso", referencedColumnName="id", unique=true)}
     *      )
     */
    private $acessos;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $descricao;

    /**
     * Perfil constructor.
     * @param $acessos
     */
    public function __construct()
    {
        $this->acessos = new ArrayCollection();
    }


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
     * @return Acesso
     */
    public function getAcessos(): array
    {
        return $this->acessos->toArray();
    }


    /**
     * @param Acesso $acesso
     */
    public function addAcesso(Acesso $acesso)
    {
        $this->acessos->add($acesso);
    }

    /**
     * @return String
     */
    public function getDescricao(): String
    {
        return $this->descricao;
    }

    /**
     * @param String $descricao
     */
    public function setDescricao(String $descricao)
    {
        $this->descricao = $descricao;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>