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
		
			/** @var \DateTime
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
	 * @return \DateTime
	 */
	public function getData(): \DateTime
	{
		return $this->data;
	}

	/**
	 * @param Date $data
	 */
	public function setData(\DateTime $data)
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