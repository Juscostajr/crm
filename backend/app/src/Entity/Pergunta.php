<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pergunta")
 */
class Pergunta
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
     * @ORM\ManyToOne(targetEntity="Campanha", inversedBy="perguntas", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="campanha", referencedColumnName="id")
     */
    private $campanha;

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

    /**
     * @return mixed
     */
    public function getCampanha(): Campanha
    {
        return $this->campanha;
    }

    /**
     * @param mixed $campanha
     */
    public function setCampanha(Campanha $campanha)
    {
        $this->campanha = $campanha;
    }



    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>