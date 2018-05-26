<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pessoa")
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="tipo", type="string")
 * @ORM\DiscriminatorMap({"pf" = "PessoaFisica", "pj" = "PessoaJuridica"})
 */
abstract class Pessoa
{

    /** @var int
     * @ORM\OneToOne(targetEntity="")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @var String
     * @ORM\Column(type="string")
     */
    private $nome;

    /** @var Telefone
     * @ORM\JoinColumn(name="telefones",referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Telefone")
     */
    private $telefones;

    /** @var Endereco
     * @ORM\JoinColumn(name="enderecos",referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Endereco", mappedBy="proprietario")
     */
    private $enderecos;

    /** @var Mail
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Acao", mappedBy="pessoa")
     * @ORM\JoinColumn(name="acoes", referencedColumnName="pessoa")
     */
    private $acoes;

    /**
     * @ORM\JoinColumn(name="grupos", referencedColumnName="id")
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="membros")
     */
    private $grupos;


    /**
     * Pessoa constructor.
     */
    public function __construct()
    {
        $this->enderecos = new ArrayCollection();
        $this->telefones = new ArrayCollection();
        $this->acoes = new ArrayCollection();
        $this->grupos = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getGrupos(): ArrayCollection
    {
        return $this->grupos;
    }

    /**
     * @param ArrayCollection $grupos
     */
    public function addGrupos(Grupo $grupo)
    {
        $this->grupos->add($grupo);
    }


    /**
     * @return mixed
     */
    public function getAcoes(): mixed
    {
        return $this->acoes;
    }

    /**
     * @param mixed $acao
     */
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
     * @return Telefone
     */
    public function getTelefones(): Telefone
    {
        return $this->telefones;
    }

    /**
     * @param Telefone $telefone
     */
    public function addTelefones(Telefone $telefone)
    {
        $this->telefones->add($telefone);
    }

    /**
     * @return Endereco
     */
    public function getEnderecos(): Endereco
    {
        return $this->enderecos;
    }

    /**
     * @param Endereco $endereco
     */
    public function addEnderecos(Endereco $endereco)
    {
        $this->enderecos->add($endereco);
    }

    /**
     * @return Mail
     */
    public function getEmail(): Mail
    {
        return $this->email;
    }

    /**
     * @param Mail $email
     */
    public function setEmail(Mail $email)
    {
        $this->email = $email;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>