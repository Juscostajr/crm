<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="feedBack")
 */

class FeedBack {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $justificativa;
		
			/** @var \DateTime
			 * @ORM\Column(type="date")
			 */
			private $data;
		
			/** @var Satisfacao
			 * @ORM\Column(type="string")
			 */
			private $indicador;
		
			/** @var \DateTime
			 * @ORM\Column(type="time")
			 */
			private $hora;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $observacao;

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
	public function getJustificativa(): String
	{
		return $this->justificativa;
	}

	/**
	 * @param String $justificativa
	 */
	public function setJustificativa(String $justificativa)
	{
		$this->justificativa = $justificativa;
	}

	/**
	 * @return \DateTime
	 */
	public function getData(): \DateTime
	{
		return $this->data;
	}

	/**
	 * @param \DateTime $data
	 */
	public function setData(\DateTime $data)
	{
		$this->data = $data;
	}

	/**
	 * @return Satisfacao
	 */
	public function getIndicador(): Satisfacao
	{
		return $this->indicador;
	}

	/**
	 * @param Satisfacao $indicador
	 */
	public function setIndicador(Satisfacao $indicador)
	{
		$this->indicador = $indicador;
	}

	/**
	 * @return \DateTime
	 */
	public function getHora(): \DateTime
	{
		return $this->hora;
	}

	/**
	 * @param \DateTime $hora
	 */
	public function setHora(\DateTime $hora)
	{
		$this->hora = $hora;
	}

	/**
	 * @return String
	 */
	public function getObservacao(): String
	{
		return $this->observacao;
	}

	/**
	 * @param String $observacao
	 */
	public function setObservacao(String $observacao)
	{
		$this->observacao = $observacao;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>