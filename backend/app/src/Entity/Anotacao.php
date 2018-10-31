<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="anotacao")
 */
class Anotacao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $data;

    /** @var \DateTime
     * @ORM\Column(type="time")
     */
    private $hora;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $titulo;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $descricao;

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
     * @return \DateTime
     */
    public function getData(): \DateTime
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     */
    public function setData(\DateTime $data)
    {
        $this->data = $data;
    }

    /**
     * @return \DateTime
     */
    public function getHora(): \DateTime
    {
        return $this->hora;
    }

    /**
     * @param \DateTime $hora
     */
    public function setHora(\DateTime $hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return String
     */
    public function getTitulo(): String
    {
        return $this->titulo;
    }

    /**
     * @param String $descricao
     */
    public function setTitulo(String $titulo)
    {
        $this->descricao = $titulo;
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