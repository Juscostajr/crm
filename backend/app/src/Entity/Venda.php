<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="venda")
 */
class Venda
{
    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="PessoaJuridica")
     * @ORM\JoinColumn(name="pessoaJuridica", referencedColumnName="id")
     */
    private $pessoaJuridica;

    /** @var Etapa
     * @ORM\Column(type="string")
     */
    private $etapa;

    /**
     * @ORM\ManyToMany(targetEntity="Servico")
     * @ORM\JoinTable(name="venda_interesses",
     *      joinColumns={@ORM\JoinColumn(name="venda", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="servico", referencedColumnName="id")}
     *      )
     */
    private $interesses;

    /**
     * Venda constructor.
     */
    public function __construct()
    {
        $this->interesses = new ArrayCollection();
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
     * @return Etapa
     */
    public function getEtapa(): string
    {
        return $this->etapa;
    }

    /**
     * @param Etapa $etapa
     */
    public function setEtapa(string $etapa)
    {
        $this->etapa = $etapa;
    }

    /**
     * @return PessoaJuridica
     */
    public function getPessoaJuridica(): PessoaJuridica
    {
        return $this->pessoaJuridica;
    }

    /**
     * @param PessoaJuridica $pessoaJuridica
     */
    public function setPessoaJuridica(PessoaJuridica $pessoaJuridica)
    {
        $this->pessoaJuridica = $pessoaJuridica;
    }

    /**
     * @return Servico
     */
    public function getInteresses(): array
    {
        return $this->interesses->toArray();
    }
    
    public function addInteresses(Servico $servico)
    {
        $this->interesses->add($servico);
    }


    public function cleanArrays()
    {
        $this->interesses = new ArrayCollection();
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>