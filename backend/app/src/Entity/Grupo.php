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
			 * @ORM\JoinColumn(name="tipo_grupo", referencedColumnName="id")
             * @ORM\ManyToOne(targetEntity="TipoGrupo")
			 */
			private $tipo;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $descricao;
		
			/**
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
	public function getDescricao(): string
	{
		return $this->descricao;
	}

	/**
	 * @param String $descricao
	 */
	public function setDescricao(string $descricao)
	{
		$this->descricao = $descricao;
	}

	/**
	 * @return Pessoa
	 */
	public function getMembros(): array
	{
		return $this->membros->toArray();
	}

	/**
	 * @param Pessoa $membro
	 */
	public function addMembro(Pessoa $membro)
	{
		$membro->addGrupos($this);
	    $this->membros->add($membro);
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>