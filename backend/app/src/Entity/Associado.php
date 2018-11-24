<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="associado")
 */
class Associado
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var Pessoa
     * @ORM\JoinColumn(name="pessoaJuridica", referencedColumnName="id")
     * @ORM\OneToOne(targetEntity="PessoaJuridica")
     */
    private $pessoaJuridica;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $dataFiliacao;

    /** @var StatusAssociado
     * @ORM\Column(type="string")
     */
    private $statusAssociado;
    /**
     * @ORM\ManyToMany(targetEntity="Interacao", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="associado_interacoes",
     *      joinColumns={@ORM\JoinColumn(name="associado", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="interacao", referencedColumnName="id")}
     *      )
     */
    private $interacaos;

    /** @var double
     * @ORM\Column(type="float")
     */
    private $valorMensalidade;

    /** @var Adesao
     * @ORM\JoinColumn(name="adesoes", referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Adesao", mappedBy="associado", cascade={"persist", "remove"})
     */
    private $adesoes;

    public function __construct()
    {
        $this->adesoes = new ArrayCollection();
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
     * @return Pessoa
     */
    public function getPessoaJuridica(): PessoaJuridica
    {
        return $this->pessoaJuridica;
    }

    /**
     * @param Pessoa $pessoa
     */
    public function setPessoaJuridica(PessoaJuridica $pessoaJuridica)
    {
        $this->pessoaJuridica = $pessoaJuridica;
    }

    /**
     * @return \DateTime
     */
    public function getDataFiliacao(): string
    {
        return $this->dataFiliacao->format('d/m/Y');
    }

    /**
     * @param \DateTime $dataFiliacao
     */
    public function setDataFiliacao(string $dataFiliacao)
    {
        $this->dataFiliacao = new \DateTime($dataFiliacao);
    }

    /**
     * @return StatusAssociado
     */
    public function getStatusAssociado(): string
    {
        return $this->statusAssociado;
    }

    /**
     * @param StatusAssociado $status
     */
    public function setStatusAssociado(StatusAssociado $statusAssociado)
    {
        $this->statusAssociado = $statusAssociado->getValue();
    }

    /**
     * @return Grupo
     */
    public function getGrupos(): Grupo
    {
        return $this->grupos;
    }

    /**
     * @param Grupo $grupos
     */
    public function setGrupos(Grupo $grupos)
    {
        $this->grupos = $grupos;
    }

    /**
     * @return float
     */
    public function getValorMensalidade(): float
    {
        return $this->valorMensalidade;
    }

    /**
     * @param float $valorMensalidade
     */
    public function setValorMensalidade(float $valorMensalidade)
    {
        $this->valorMensalidade = $valorMensalidade;
    }

    /**
     * @return Adesao
     */
    public function getAdesoes(): array
    {
        return $this->adesoes->toArray();
    }

    public function addAdesoes(Adesao $adesao)
    {
        $this->adesoes->add($adesao);
    }

    public function getInteracaos(): array
    {
        return $this->interacaos->toArray();
    }

    public function addInteracaos(Interacao $interacao)
    {
        $this->interacaos->add($interacao);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>