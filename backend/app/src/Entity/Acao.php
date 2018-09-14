<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="acao")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="disc", type="string")
 * @ORM\DiscriminatorMap({"venda" = "Venda", "interacao" = "Interacao", "campanha" = "Campanha"})
 */

abstract class Acao {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Pessoa
			 * @ORM\JoinColumn(name="pessoa", referencedColumnName="id")
			 * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="acoes")
			 */
			private $pessoa;
		
			/** @var Usuario
			 * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
			 * @ORM\ManyToOne(targetEntity="Usuario")
			 */
			private $usuario;

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
	 * @return Usuario
	 */
	public function getUsuario(): Usuario
	{
		return $this->usuario;
	}

	/**
	 * @param Usuario $usuario
	 */
	public function setUsuario(Usuario $usuario)
	{
		$this->usuario = $usuario;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>