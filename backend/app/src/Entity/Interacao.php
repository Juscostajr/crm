<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="interacao")
 */
class Interacao
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var FeedBack
     * @ORM\JoinColumn(name="feedback", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="FeedBack")
     */
    private $feedback;

    /** @var Usuario
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $usuario;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $data;

    /** @var \DateTime
     * @ORM\Column(type="time")
     */
    private $hora;

    /** @var TipoInteracao
     * @ORM\Column(type="string")
     */
    private $tipo;

    /**
     * @ORM\ManyToMany(targetEntity="Anotacao", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="interacao_anotacoes",
     *      joinColumns={@ORM\JoinColumn(name="interacao", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="anotacao", referencedColumnName="id")}
     *      )
     */
    private $anotacaos;

    /**
     * @ORM\Column(name="sentido", type="string")
     */
    private $sentido;

    /**
     * Interacao constructor.
     */
    public function __construct()
    {
        $this->anotacaos = new ArrayCollection();
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
     * @return FeedBack
     */
    public function getFeedback(): FeedBack
    {
        return $this->feedback;
    }

    /**
     * @param FeedBack $feedback
     */
    public function setFeedback(FeedBack $feedback)
    {
        $this->feedback = $feedback;
    }


    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
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
     * @return TipoInteracao
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param TipoInteracao $tipo
     */
    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return Anotacao
     */
    public function getAnotacaos(): array
    {
        return $this->anotacaos->toArray();
    }

    /**
     * @param Anotacao $anotacao
     */
    public function addAnotacaos(Anotacao $anotacao)
    {
        $this->anotacaos->add($anotacao);
    }

    /**
     * @return mixed
     */
    public function getSentido(): string
    {
        return $this->sentido;
    }

    /**
     * @param Sentido $sentido
     */
    public function setSentido(string $sentido)
    {
        $this->sentido = $sentido;
    }


    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>