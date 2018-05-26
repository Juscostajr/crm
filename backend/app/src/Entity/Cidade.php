<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cidade")
 */

class Cidade {
		
			/** @var int
			 * @ORM\ID
			 * @ORM\Column(type="integer")
			 */ 
			private $ibge;
		
			/** @var Uf
			 * @ORM\ManyToOne(targetEntity="Uf")
			 * @ORM\JoinColumn(name="uf", referencedColumnName="ibge")
			 */ 
			private $uf;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */ 
			private $nome;
		
			/** @var Coordenadas
			 * @ORM\JoinColumn(name="coordenadas", referencedColumnName="id")
			 * @ORM\OneToOne(targetEntity="Coordenadas")
			 */ 
			private $coordenadas;

	/**
	 * @return int
	 */
	public function getIbge(): int
	{
		return $this->ibge;
	}

	/**
	 * @param int $ibge
	 */
	public function setIbge(int $ibge)
	{
		$this->ibge = $ibge;
	}

	/**
	 * @return Uf
	 */
	public function getUf(): Uf
	{
		return $this->uf;
	}

	/**
	 * @param Uf $uf
	 */
	public function setUf(Uf $uf)
	{
		$this->uf = $uf;
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

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>