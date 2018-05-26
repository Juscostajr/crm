<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $login;

    /** @var PessoaFisica
     * @ORM\JoinColumn(name="pessoa",referencedColumnName="id")
     * @ORM\OneToOne(targetEntity="PessoaFisica")
     */
    private $pessoa;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $senha;

    /** @var Perfil
     * @ORM\JoinColumn(name="perfis",referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Perfil", mappedBy="usuario")
     */
    private $perfis;
    /**
     * @ORM\JoinColumn(name="acoes", referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Acao", mappedBy="usuario")
     */
    private $acoes;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->perfis = new ArrayCollection();
        $this->acoes = new ArrayCollection();
    }


    public function getAcoes(): Acao
    {
        return $this->acoes;
    }

    public function addAcoes(Acao $acao)
    {
        $this->acoes->add($acao);
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
     * @return String
     */
    public function getLogin(): String
    {
        return $this->login;
    }

    /**
     * @param String $login
     */
    public function setLogin(String $login)
    {
        $this->login = $login;
    }

    /**
     * @return PessoaFisica
     */
    public function getPessoa(): PessoaFisica
    {
        return $this->pessoa;
    }

    /**
     * @param PessoaFisica $pessoa
     */
    public function setPessoa(PessoaFisica $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * @return String
     */
    public function getSenha(): String
    {
        return $this->senha;
    }

    /**
     * @param String $senha
     */
    public function setSenha(String $senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return Perfil
     */
    public function getPerfis(): Perfil
    {
        return $this->perfis;
    }

    /**
     * @param Perfil $perfil
     */
    public function addPerfis(Perfil $perfil)
    {
        $this->perfis->add($perfil);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>