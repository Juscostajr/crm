<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="campanha")
 */

class Campanha {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Grupo
			 * @ORM\JoinColumn(name="target", referencedColumnName="id")
			 * @ORM\ManyToOne(targetEntity="Grupo")
			 */
			private $target;
		
			/** @var FeedBack
			 * @ORM\JoinColumn(name="feedback", referencedColumnName="id")
			 * @ORM\ManyToOne(targetEntity="FeedBack")
			 */
			private $feedback;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $nome;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $descricao;
		
			/** @var \DateTime
			 * @ORM\Column(type="date")
			 */
			private $inicio;
		
			/** @var \DateTime
			 * @ORM\Column(type="date")
			 */
			private $final;

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
	 * @return Grupo
	 */
	public function getTarget(): Grupo
	{
		return $this->target;
	}

	/**
	 * @param Grupo $target
	 */
	public function setTarget(Grupo $target)
	{
		$this->target = $target;
	}

	/**
	 * @return FeedBack
	 */
	public function getFeedback(): FeedBack
	{
		return $this->feedback;
	}

	/**
	 * @param FeedBack $feedback
	 */
	public function setFeedback(FeedBack $feedback)
	{
		$this->feedback = $feedback;
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
	 * @return \DateTime
	 */
	public function getInicio(): \DateTime
	{
		return $this->inicio;
	}

	/**
	 * @param \DateTime $inicio
	 */
	public function setInicio(\DateTime $inicio)
	{
		$this->inicio = $inicio;
	}

	/**
	 * @return \DateTime
	 */
	public function getFinal(): \DateTime
	{
		return $this->final;
	}

	/**
	 * @param \DateTime $final
	 */
	public function setFinal(\DateTime $final)
	{
		$this->final = $final;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>