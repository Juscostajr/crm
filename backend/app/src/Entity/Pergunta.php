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
     * @ORM\JoinColumn(name="checklist", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="CheckList", inversedBy="perguntas")
     */
    private $checklist;

    /**
     * @return CheckList
     */
    public function getChecklist(): CheckList
    {
        return $this->checklist;
    }

    /**
     * @param CheckList $checklist
     */
    public function setChecklist(CheckList $checklist)
    {
        $this->checklist = $checklist;
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