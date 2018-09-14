<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="venda")
 */
class Venda extends Acao
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var Etapa
     * @ORM\Column(type="string")
     */
    private $etapa;

    /** @var Servico
     * @ORM\ManyToMany(targetEntity="Servico",mappedBy="")
     * @ORM\JoinColumn(name="interesses", referencedColumnName="id")
     */
    /**
     * @ORM\ManyToMany(targetEntity="Servico")
     * @ORM\JoinTable(name="venda_interesses",
     *      joinColumns={@ORM\JoinColumn(name="servico", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="venda", referencedColumnName="id")}
     *      )
     */
    private $interesses;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $data;

    /** @var \DateTime
     * @ORM\Column(type="time")
     */
    private $hora;

    /**
     * Venda constructor.
     */
    public function __construct()
    {
        $this->interesses = new ArrayCollection();
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
     * @return Etapa
     */
    public function getEtapa(): Etapa
    {
        return $this->etapa;
    }

    /**
     * @param Etapa $etapa
     */
    public function setEtapa(Etapa $etapa)
    {
        $this->etapa = $etapa;
    }

    /**
     * @return Servico
     */
    public function getInteresses(): Servico
    {
        return $this->interesses;
    }
    
    public function setInteresses(array $interesses)
    {
        $this->interesses = new ArrayCollection($interesses);
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

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>