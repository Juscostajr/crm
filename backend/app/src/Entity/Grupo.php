<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grupo")
 */

class Grupo {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var TipoGrupo
			 * @ORM\Column(type="string")
			 */
			private $tipo;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $descricao;
		
			/** @var Pessoa
			 * @ORM\JoinColumn(name="membros", referencedColumnName="id")
			 * @ORM\ManyToMany(targetEntity="Pessoa",mappedBy="grupos")
			 */
			private $membros;

	/**
	 * Grupo constructor.
	 */
	public function __construct()
	{
		$this->membros = new ArrayCollection();
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
	 * @return TipoGrupo
	 */
	public function getTipo(): TipoGrupo
	{
		return $this->tipo;
	}

	/**
	 * @param TipoGrupo $tipo
	 */
	public function setTipo(TipoGrupo $tipo)
	{
		$this->tipo = $tipo;
	}

	/**
	 * @return String
	 */
	public function getDescricao(): String
	{
		return $this->descricao;
	}

	/**
	 * @param String $descricao
	 */
	public function setDescricao(String $descricao)
	{
		$this->descricao = $descricao;
	}

	/**
	 * @return Pessoa
	 */
	public function getMembros(): Pessoa
	{
		return $this->membros;
	}

	/**
	 * @param Pessoa $membro
	 */
	public function addMembro(Pessoa $membro)
	{
		$this->membros->add($membro);
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>