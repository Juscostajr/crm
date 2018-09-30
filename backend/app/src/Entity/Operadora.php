<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="operadora")
 */
class Operadora {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $nome;


    /**
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(name="telefone",referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Telefone", mappedBy="operadora", cascade={"persist","remove"})
     */

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

	public function toArray()
	{
		return get_object_vars($this);
	}

}
?>