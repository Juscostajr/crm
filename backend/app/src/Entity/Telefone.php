<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="telefone")
 */

class Telefone {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */ 
			private $id;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */ 
			private $numero;

		
			/** @var Operadora
			 * @ORM\JoinColumn(name="operadora", referencedColumnName="id")
			 * @ORM\ManyToOne(targetEntity="Operadora", inversedBy="telefones")
			 */ 
			private $operadora;
		
			/** @var TipoTelefone
			 * @ORM\Column(type="string")
			 */ 
			private $tipo;

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
	 * @return String
	 */
	public function getNumero(): String
	{
		return $this->numero;
	}

	/**
	 * @param String $numero
	 */
	public function setNumero(String $numero)
	{
		$this->numero = $numero;
	}


	/**
	 * @return Operadora
	 */
	public function getOperadora(): Operadora
	{
		return $this->operadora;
	}

	/**
	 * @param Operadora $operadora
	 */
	public function setOperadora(Operadora $operadora)
	{
		$this->operadora = $operadora;
	}

	/**
	 * @return TipoTelefone
	 */
	public function getTipo(): TipoTelefone
	{
		return $this->tipo;
	}

	/**
	 * @param TipoTelefone $tipo
	 */
	public function setTipo(string $tipo)
	{
		$this->tipo = $tipo;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>