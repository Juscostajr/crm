<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pessoaFisica")
 */
class PessoaFisica extends Pessoa
{

    /** @var Cpf
     * @ORM\Column(type="string")
     */
    private $cpf;

    /** @var String
     * @ORM\Column(type="string")
     */
    protected $nome;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $dtNascimento;

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
     * @return Cpf
     */
    public function getCpf(): Cpf
    {
        return $this->cpf;
    }

    /**
     * @param Cpf $cpf
     */
    public function setCpf(Cpf $cpf)
    {
        $this->cpf = $cpf->getNumero();
    }

    /**
     * @return \DateTime
     */
    public function getDtNascimento(): \DateTime
    {
        return $this->dtNascimento->format('d/m/Y');
    }

    public function setDtNascimento(string $dtNascimento)
    {
        $this->dtNascimento = new \DateTime($dtNascimento);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>