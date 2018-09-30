<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="endereco")
 */

class Endereco {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Cep
			 * @ORM\Column(type="string")
			 */
			private $cep;
		
			/** @var int
			 * @ORM\Column(type="integer")
			 */
			private $nrImovel;

		
			/** @var Cidade
			 * @ORM\JoinColumn(name="cidade", referencedColumnName="ibge")
			 * @ORM\ManyToOne(targetEntity="Cidade", cascade={"persist"})
			 */
			private $cidade;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $logradouro;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $complemento;
		
			/** @var Coordenadas
			 * @ORM\JoinColumn(name="coordenadas",referencedColumnName="id")
			 * @ORM\OneToOne(targetEntity="Coordenadas", cascade={"persist"})
			 */
			private $coordenadas;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $bairro;

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
	 * @return Cep
	 */
	public function getCep(): Cep
	{
		return $this->cep;
	}

	/**
	 * @param Cep $cep
	 */
	public function setCep(Cep $cep)
	{
		$this->cep = $cep->getNumero();
	}

	/**
	 * @return int
	 */
	public function getNrImovel(): int
	{
		return $this->nrImovel;
	}

	/**
	 * @param int $nrImovel
	 */
	public function setNrImovel(int $nrImovel)
	{
		$this->nrImovel = $nrImovel;
	}

	/**
	 * @return Cidade
	 */
	public function getCidade(): Cidade
	{
		return $this->cidade;
	}

	/**
	 * @param Cidade $cidade
	 */
	public function setCidade(Cidade $cidade)
	{
		$this->cidade = $cidade;
	}

	/**
	 * @return String
	 */
	public function getLogradouro(): String
	{
		return $this->logradouro;
	}

	/**
	 * @param String $logradouro
	 */
	public function setLogradouro(String $logradouro)
	{
		$this->logradouro = $logradouro;
	}

	/**
	 * @return String
	 */
	public function getComplemento(): String
	{
		return $this->complemento;
	}

	/**
	 * @param String $complemento
	 */
	public function setComplemento(String $complemento)
	{
		$this->complemento = $complemento;
	}

	/**
	 * @return Coordenadas
	 */
	public function getCoordenadas(): Coordenadas
	{
		return $this->coordenadas;
	}

	/**
	 * @param Coordenadas $coordenadas
	 */
	public function setCoordenadas(Coordenadas $coordenadas)
	{
		$this->coordenadas = $coordenadas;
	}

	/**
	 * @return String
	 */
	public function getBairro(): String
	{
		return $this->bairro;
	}

	/**
	 * @param String $bairro
	 */
	public function setBairro(String $bairro)
	{
		$this->bairro = $bairro;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
		
}
?>