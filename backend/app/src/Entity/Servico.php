<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="servico")
 */
class Servico
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="Adesao", mappedBy="servico")
     * @ORM\JoinColumn(name="adesoes", referencedColumnName="id")
     */
    private $adesoes;

    /**
     * Servico constructor.
     */
    public function __construct()
    {
        $this->adesoes = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getAdesoes(): Adesao
    {
        return $this->adesoes;
    }

    public function addAdesoes(Adesao $adesao)
    {
        $this->adesoes->add($adesao);
    }

    public function setAdesoes(array $adesoes)
    {
        $this->adesoes = new ArrayCollection($adesoes);
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