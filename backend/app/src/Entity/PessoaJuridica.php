<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pessoaJuridica")
 */

class PessoaJuridica extends Pessoa {
	
			/** @var int
			 * @ORM\Column(type="integer")
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
			 * @ORM\ManyToOne(targetEntity="Pessoa")
			 */
			private $representanteLegal;

	/**
	 * @return int
	 */
	public function getRamoAtividade(): int
	{
		return $this->ramoAtividade;
	}

	/**
	 * @param int $ramoAtividade
	 */
	public function setRamoAtividade(int $ramoAtividade)
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
		$this->inscricaoEstadual = $inscricaoEstadual;
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