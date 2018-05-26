<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perfil")
 */

class Perfil {
		
			/** @var int
			 * @ORM\Id
			 * @ORM\GeneratedValue(strategy="AUTO")
			 * @ORM\Column(type="integer")
			 */
			private $id;
		
			/** @var Acesso
			 * @ORM\Column(type="string")
			 */
			private $acessos;
		
			/** @var String
			 * @ORM\Column(type="string")
			 */
			private $descricao;
	/**
	 * @var Usuario
	 * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="perfis")
	 * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
	 */
	private $usuario;

	/**
	 * @return Usuario
	 */
	public function getUsuario(): Usuario
	{
		return $this->usuario;
	}

	/**
	 * @param Usuario $usuario
	 */
	public function setUsuario(Usuario $usuario)
	{
		$this->usuario = $usuario;
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
	 * @return Acesso
	 */
	public function getAcessos(): Acesso
	{
		return $this->acessos;
	}

	/**
	 * @param Acesso $acessos
	 */
	public function setAcessos(Acesso $acessos)
	{
		$this->acessos = $acessos;
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

	public function toArray()
	{
		return get_object_vars($this);
	}
}
?>