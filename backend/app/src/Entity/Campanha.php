<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="campanha")
 */
class Campanha
{

    /**
     * Campanha constructor.
     */
    public function __construct()
    {
        $this->perguntas = new ArrayCollection();
    }

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var Grupo
     * @ORM\JoinColumn(name="target", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Grupo")
     */
    private $target;

    /**
     * @ORM\ManyToOne(targetEntity="Servico")
     * @ORM\JoinColumn(name="servico", referencedColumnName="id")
     */
    private $servico;

    /** @var FeedBack
     * @ORM\JoinColumn(name="feedback", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="FeedBack")
     */
    private $feedback;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $nome;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $descricao;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $inicio;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $final;

    /**
     * @ORM\OneToMany(targetEntity="Pergunta", mappedBy="campanha", cascade={"persist","remove"})
     */
    private $perguntas;


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
     * @return Grupo
     */
    public function getTarget(): Grupo
    {
        return $this->target;
    }

    /**
     * @param Grupo $target
     */
    public function setTarget(Grupo $target)
    {
        $this->target = $target;
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
     * @return Servico
     */
    public function getServico(): Servico
    {
        return $this->servico;
    }


    public function setServico(Servico $servico)
    {
        $this->servico = $servico;
    }

    /**
     * @return String
     */
    public function getNome(): String
    {
        return $this->nome;
    }

    /**
     * @param String $nome
     */
    public function setNome(String $nome)
    {
        $this->nome = $nome;
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
     * @return \DateTime
     */
    public function getInicio(): string
    {
        return $this->inicio->format('d/m/Y');
    }

    /**
     * @param \DateTime $inicio
     */
    public function setInicio(string $inicio)
    {
        $this->inicio = new \DateTime($inicio);
    }

    /**
     * @return \DateTime
     */
    public function getFinal(): string
    {
        return $this->final->format('d/m/Y');
    }

    /**
     * @param \DateTime $final
     */
    public function setFinal(string $final)
    {
        $this->final = new \DateTime($final);
    }

    public function addPergunta(Pergunta $pergunta){
        $this->perguntas->add($pergunta);
    }

    public function getPergunta(): array
    {
        return $this->perguntas->toArray();
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>