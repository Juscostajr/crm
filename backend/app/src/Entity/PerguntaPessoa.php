<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perguntaPessoa")
 */
class PerguntaPessoa
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /** @var Pessoa
     * @ORM\JoinColumn(name="pessoa", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Pessoa")
     */
    private $pessoa;

    /** @var Pergunta
     * @ORM\JoinColumn(name="pergunta", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Pergunta")
     */
    private $pergunta;

    /** @var boolean
     * @ORM\Column(type="boolean")
     */
    private $resposta;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id)
    {
        $this->id = $id;
    }

    /**
     * @return Pessoa
     */
    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    /**
     * @param Pessoa $pessoa
     */
    public function setPessoa(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * @return Pergunta
     */
    public function getPergunta(): Pergunta
    {
        return $this->pergunta;
    }

    /**
     * @param Pergunta $pergunta
     */
    public function setPergunta(Pergunta $pergunta)
    {
        $this->pergunta = $pergunta;
    }

    /**
     * @return boolean
     */
    public function isResposta(): boolean
    {
        return $this->resposta;
    }

    /**
     * @param boolean $resposta
     */
    public function setResposta(boolean $resposta)
    {
        $this->resposta = $resposta;
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

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>