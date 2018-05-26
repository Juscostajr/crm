<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="checkList")
 */

class CheckList {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Pergunta
			 * @ORM\JoinColumn(name="perguntas", referencedColumnName="id")
			 * @ORM\OneToMany(targetEntity="Pergunta", mappedBy="checklist")
			 */
			private $perguntas;

		
			/**
			 * @var Grupo
			 * @ORM\JoinColumn(name="grupo", referencedColumnName="id")
			 * @ORM\ManyToOne(targetEntity="Grupo")
			 */
			private $grupo;


	public function __construct()
	{
		$this->perguntas = new ArrayCollection();
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
	 * @return Pergunta
	 */
	public function getPerguntas(): Pergunta
	{
		return $this->perguntas;
	}

	/**
	 * @param Pergunta $perguntas
	 */
	public function setPerguntas(Pergunta $perguntas)
	{
		$this->perguntas = $perguntas;
	}

	/**
	 * @return Grupo
	 */
	public function getGrupo(): Grupo
	{
		return $this->grupo;
	}

	/**
	 * @param Grupo $grupo
	 */
	public function setGrupo(Grupo $grupo)
	{
		$this->grupo = $grupo;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>