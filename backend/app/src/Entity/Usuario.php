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

    /**
     * @ORM\ManyToMany(targetEntity="Perfil")
     * @ORM\JoinTable(name="perfil_usuario",
     *      joinColumns={@ORM\JoinColumn(name="usuario", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="perfil", referencedColumnName="id")}
     *      )
     */
    private $perfils;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $senhaExpirada;


    private $rotas;

    /**
     * @return mixed
     */
    public function getRotas(): array
    {
        return $this->rotas;
    }

    /**
     * @param mixed $rotas
     */
    public function setRotas(array $rotas)
    {
        $this->rotas = $rotas;
    }


    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->perfils = new ArrayCollection();
        $this->acoes = new ArrayCollection();
    }

    /**
     * @return bool
     */
    public function getSenhaExpirada(): bool
    {
        return $this->senhaExpirada;
    }

    /**
     * @param bool $senhaExpirada
     */
    public function setSenhaExpirada(bool $senhaExpirada)
    {
        $this->senhaExpirada = $senhaExpirada;
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
     * @param String $senha
     */
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @return Perfil
     */
    public function getPerfils(): Perfil
    {
        return $this->perfils->toArray();
    }

    /**
     * @param Perfil $perfil
     */
    public function addPerfil(Perfil $perfil)
    {
        $this->perfils->add($perfil);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>