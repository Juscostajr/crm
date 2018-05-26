<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="interacao")
 */
class Interacao extends Acao
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

    /** @var Acao
     * @ORM\JoinColumn(name="acao",referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Acao")
     */
    private $acao;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $data;

    /** @var \Time
     * @ORM\Column(type="time")
     */
    private $hora;

    /** @var TipoInteracao
     * @ORM\Column(type="string")
     */
    private $tipo;

    /** @var Anotacao
     * @ORM\JoinColumn(name="anotacoes",referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Anotacao", mappedBy="interacao")
     */
    private $anotacoes;

    /**
     * Interacao constructor.
     */
    public function __construct()
    {
        $this->anotacoes = new ArrayCollection();
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
     * @return Acao
     */
    public function getAcao(): Acao
    {
        return $this->acao;
    }

    /**
     * @param Acao $acao
     */
    public function setAcao(Acao $acao)
    {
        $this->acao = $acao;
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
     * @return \Time
     */
    public function getHora(): \Time
    {
        return $this->hora;
    }

    /**
     * @param \Time $hora
     */
    public function setHora(\Time $hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return TipoInteracao
     */
    public function getTipo(): TipoInteracao
    {
        return $this->tipo;
    }

    /**
     * @param TipoInteracao $tipo
     */
    public function setTipo(TipoInteracao $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return Anotacao
     */
    public function getAnotacoes(): Anotacao
    {
        return $this->anotacoes;
    }

    /**
     * @param Anotacao $anotacao
     */
    public function addAnotacoes(Anotacao $anotacao)
    {
        $this->anotacoes->add($anotacao);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>