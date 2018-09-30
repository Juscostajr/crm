<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="coordenadas")
 */
class Coordenadas {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
    private $id;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $latitude;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $longitude;

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
	public function getLatitude(): String
	{
		return $this->latitude;
	}

	/**
	 * @param String $latitude
	 */
	public function setLatitude(String $latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 * @return String
	 */
	public function getLongitude(): String
	{
		return $this->longitude;
	}

	/**
	 * @param String $longitude
	 */
	public function setLongitude(String $longitude)
	{
		$this->longitude = $longitude;
	}
	
	public function toArray()
	{
		return get_object_vars($this);
	}

}
?>