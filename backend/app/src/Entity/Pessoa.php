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
    protected $id;

    /** @var Telefone
     * @ORM\JoinColumn(name="telefone",referencedColumnName="id")
     * @ORM\OneToMany(targetEntity="Telefone", cascade={"persist", "remove"})
     */

    /**
     * @ORM\ManyToMany(targetEntity="Telefone", cascade={"persist"})
     * @ORM\JoinTable(name="telefone_pessoa",
     *      joinColumns={@ORM\JoinColumn(name="pessoa", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="telefone", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $telefones;

    /**
     * @ORM\ManyToMany(targetEntity="Endereco", cascade={"persist"})
     * @ORM\JoinTable(name="endereco_pessoa",
     *      joinColumns={@ORM\JoinColumn(name="pessoa", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="endereco", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $enderecos;

    /** @var Mail
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\JoinColumn(name="grupos", referencedColumnName="id")
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="membros", cascade={"persist", "remove"})
     */
    protected $grupos;


    /**
     * Pessoa constructor.
     */
    public function __construct()
    {
        $this->enderecos = new ArrayCollection();
        $this->telefones = new ArrayCollection();
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

    public function setGrupos(array $grupos)
    {
        $this->grupos = new ArrayCollection($grupos);
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
        $this->email = $email->getEmail();
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>