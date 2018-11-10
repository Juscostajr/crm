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
    public function getData(): string
    {
        return $this->data->format('d/m/Y');
    }

    /**
     * @param \DateTime $data
     */
    public function setData(string $data)
    {
        $this->data = new \DateTime($data);
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
    public function setHora(string $hora)
    {
        $this->hora = new \DateTime($hora);
    }

    /**
     * @return String
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @param String $descricao
     */
    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return String
     */
    public function getDescricao(): string
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