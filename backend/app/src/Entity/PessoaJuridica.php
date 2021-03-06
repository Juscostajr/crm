<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pessoaJuridica")
 */
class PessoaJuridica extends Pessoa
{

    /** @var Cnpj
     * @ORM\Column(type="string")
     */
    private $cnpj;

    /** @var string
     * @ORM\Column(type="string")
     */
    private $razaoSocial;

    /** @var RamoAtividade
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(name="ramo_atividade", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="RamoAtividade")
     */
    private $ramoAtividade;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $nomeFantasia;

    /** @var InscricaoEstadual
     * @ORM\Column(type="string")
     */
    private $inscricaoEstadual;

    /** @var int
     * @ORM\Column(type="integer")
     */
    private $numeroFuncionarios;

    /** @var PessoaFisica
     * @ORM\JoinColumn(name="representanteLegal", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="PessoaFisica" ,cascade={"persist"})
     */
    private $representanteLegal;

    /**
     * @return Cnpj
     */
    public function getCnpj(): Cnpj
    {
        return $this->cnpj;
    }

    /**
     * @param Cnpj $cnpj
     */
    public function setCnpj(Cnpj $cnpj)
    {
        $this->cnpj = $cnpj->getNumero();
    }

    /**
     * @return string
     */
    public function getRazaoSocial(): string
    {
        return $this->razaoSocial;
    }

    /**
     * @param string $razaoSocial
     */
    public function setRazaoSocial(string $razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    }


    /**
     * @return int
     */
    public function getRamoAtividade(): RamoAtividade
    {
        return $this->ramoAtividade;
    }

    /**
     * @param RamoAtividade $ramoAtividade
     */
    public function setRamoAtividade(RamoAtividade $ramoAtividade)
    {
        $this->ramoAtividade = $ramoAtividade;
    }

    /**
     * @return String
     */
    public function getNomeFantasia(): String
    {
        return $this->nomeFantasia;
    }

    /**
     * @param String $nomeFantasia
     */
    public function setNomeFantasia(String $nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
    }

    /**
     * @return InscricaoEstadual
     */
    public function getInscricaoEstadual(): InscricaoEstadual
    {
        return $this->inscricaoEstadual;
    }

    /**
     * @param InscricaoEstadual $inscricaoEstadual
     */
    public function setInscricaoEstadual(InscricaoEstadual $inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual->getNumero();
    }

    /**
     * @return int
     */
    public function getNumeroFuncionarios(): int
    {
        return $this->numeroFuncionarios;
    }

    /**
     * @param int $numeroFuncionarios
     */
    public function setNumeroFuncionarios(int $numeroFuncionarios)
    {
        $this->numeroFuncionarios = $numeroFuncionarios;
    }

    /**
     * @return PessoaFisica
     */
    public function getRepresentanteLegal(): PessoaFisica
    {
        return $this->representanteLegal;
    }

    /**
     * @param PessoaFisica $representanteLegal
     */
    public function setRepresentanteLegal(PessoaFisica $representanteLegal)
    {
        $this->representanteLegal = $representanteLegal;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>