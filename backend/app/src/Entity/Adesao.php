<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="adesao")
 */

class Adesao {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Date
			 * @ORM\Column(type="string")
			 */
			private $data;
		
			/** @var Servico
			 *  @ORM\ManyToOne(targetEntity="Servico", inversedBy="adesoes")
			 * @ORM\JoinColumn(name="servico", referencedColumnName="id")
			 */
			private $servico;
		
			/** @var Associado
			 * @ORM\ManyToOne(targetEntity="Associado", inversedBy="adesoes")
			 * @ORM\JoinColumn(name="associado", referencedColumnName="id")
			 */
			private $associado;

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
	 * @return Date
	 */
	public function getData(): Date
	{
		return $this->data;
	}

	/**
	 * @param Date $data
	 */
	public function setData(Date $data)
	{
		$this->data = $data;
	}

	/**
	 * @return Servico
	 */
	public function getServico(): Servico
	{
		return $this->servico;
	}

	/**
	 * @param Servico $servico
	 */
	public function setServico(Servico $servico)
	{
		$this->servico = $servico;
	}

	/**
	 * @return Associado
	 */
	public function getAssociado(): Associado
	{
		return $this->associado;
	}

	/**
	 * @param Associado $associado
	 */
	public function setAssociado(Associado $associado)
	{
		$this->associado = $associado;
	}
	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>