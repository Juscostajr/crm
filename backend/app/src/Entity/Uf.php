<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="uf")
 */

class Uf {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\Column(type="integer")
			 */ 
			private $ibge;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */ 
			private $sigla;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */ 
			private $nome;

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
	 * @return String
	 */
	public function getSigla(): String
	{
		return $this->sigla;
	}

	/**
	 * @param String $sigla
	 */
	public function setSigla(String $sigla)
	{
		$this->sigla = $sigla;
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

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>