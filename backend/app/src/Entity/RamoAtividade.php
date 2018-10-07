<?php

namespace App\Entity;
use \Doctrine\ORM\Mapping as ORM;

/**
 * Class RamoAtividade
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="ramo_atividade")
 */
class RamoAtividade {
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
	private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
	private $descricao;
    /**
     * @var Secao
     * @ORM\JoinColumn(name="secao", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Secao")
     */
	private $secao;

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
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return Secao
     */
    public function getSecao(): Secao
    {
        return $this->secao;
    }

    /**
     * @param Secao $secao
     */
    public function setSecao(Secao $secao)
    {
        $this->secao = $secao;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
    public function __toString()
    {
        return (string) $this->getId();
    }
}
?>