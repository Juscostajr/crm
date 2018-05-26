<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="desfiliacao")
 */

class Desfiliacao {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Associado
			 * @ORM\ManyToOne(targetEntity="associado")
			 * @ORM\JoinColumn(name="associado", referencedColumnName="id")
			 */
			private $associado;
		
			/** @var \DateTime
			 * @ORM\Column(type="date")
			 */
			private $data;

			private $motivos = array();

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
	 * @return MotivoDesfiliacao
	 */
	public function getMotivos(): array
	{
		return $this->motivos;
	}

	/**
	 * @param MotivoDesfiliacao $motivo
	 */
	public function addMotivo(MotivoDesfiliacao $motivo)
	{
		array_push($this->motivos,$motivo);
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>