<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="associado")
 */

class Associado {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Pessoa
			 * @ORM\JoinColumn(name="pessoa", referencedColumnName="id")
			 * @ORM\OneToOne(targetEntity="Pessoa")
			 */
			private $pessoa;
		
			/** @var \DateTime
			 * @ORM\Column(type="date")
			 */
			private $dataFiliacao;
		
			/** @var StatusAssociado
			 * @ORM\Column(type="string")
			 */
			private $status;

			/** @var double
			 * @ORM\Column(type="float")
			 */
			private $valorMensalidade;
		
			/** @var Adesao
			 * @ORM\JoinColumn(name="adesoes", referencedColumnName="id")
			 * @ORM\OneToMany(targetEntity="Adesao", mappedBy="associado")
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
	 * @return \DateTime
	 */
	public function getDataFiliacao(): \DateTime
	{
		return $this->dataFiliacao;
	}

	/**
	 * @param \DateTime $dataFiliacao
	 */
	public function setDataFiliacao(\DateTime $dataFiliacao)
	{
		$this->dataFiliacao = $dataFiliacao;
	}

	/**
	 * @return StatusAssociado
	 */
	public function getStatus(): StatusAssociado
	{
		return $this->status;
	}

	/**
	 * @param StatusAssociado $status
	 */
	public function setStatus(StatusAssociado $status)
	{
		$this->status = $status;
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
	public function getAdesoes(): Adesao
	{
		return $this->adesoes;
	}

	/**
	 * @param Adesao $adesoes
	 */
	public function setAdesoes(Adesao $adesoes)
	{
		$this->adesoes = $adesoes;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>