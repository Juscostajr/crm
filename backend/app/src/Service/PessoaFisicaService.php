<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\PessoaFisica;

class PessoaFisicaService {

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAll()
    {
        $pessoaFisicas = $this->em->getRepository('\App\Entity\PessoaFisica')->findAll();

        if (!$pessoaFisicas) {
            throw new \Exception("PessoaFisicas not found", 404);
        }

        return $pessoaFisicas;
    }

    public function findOne(int $id): PessoaFisica
    {
        $pessoaFisica = $this->em->getRepository('\App\Entity\PessoaFisica')->find($id);

        if (!$pessoaFisica) {
            throw new \Exception("PessoaFisica not found", 404);
        }

        return $pessoaFisica;
    }

    public function delete(int $id)
    {
        $pessoaFisica = $this->findOne($id);

        $this->em->remove($pessoaFisica);
        $this->em->flush();
    }

    public function create($nome, $telefones, $enderecos, $email, $acoes, $grupos, $dtNascimento)
    {
        $pessoaFisica = new PessoaFisica();
        $pessoaFisica->setNome($nome);
        $pessoaFisica->setTelefones($telefones);
        $pessoaFisica->setEnderecos($enderecos);
        $pessoaFisica->setEmail($email);
        $pessoaFisica->setAcoes($acoes);
        $pessoaFisica->setGrupos($grupos);
        $pessoaFisica->setCpf($nome);
        $pessoaFisica->setDtNascimento( $dtNascimento);


        $this->em->persist($pessoaFisica);
        $this->em->flush();
    }

    public function update(int $id, $nome, $cpf, $telefones, $enderecos, $email, $acoes, $grupos, $dtNascimento)
    {
        $pessoaFisica = $this->findOne($id);
        $pessoaFisica->setNome($nome);
        $pessoaFisica->setTelefones($telefones);
        $pessoaFisica->setEnderecos($enderecos);
        $pessoaFisica->setEmail($email);
        $pessoaFisica->setAcoes($acoes);
        $pessoaFisica->setGrupos($grupos);
        $pessoaFisica->setCpf($nome);
        $pessoaFisica->setDtNascimento( $dtNascimento);

        $this->em->persist($pessoaFisica);
        $this->em->flush();
    }

}
