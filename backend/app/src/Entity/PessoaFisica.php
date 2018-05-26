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

    /** @var \DateTime
     * @ORM\Column(type="string")
     */
    private $dtNascimento;


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
        $this->cpf = $cpf;
    }

    /**
     * @return \DateTime
     */
    public function getDtNascimento(): \DateTime
    {
        return $this->dtNascimento;
    }

    /**
     * @param \DateTime $dtNascimento
     */
    public function setDtNascimento(\DateTime $dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>