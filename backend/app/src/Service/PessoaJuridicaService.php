<?php
namespace App\Service;

use App\Entity\PessoaJuridica;
use Doctrine\ORM\EntityManager;

class PessoaJuridicaService
{

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
        $pessoaJuridicas = $this->em->getRepository('\App\Entity\PessoaJuridica')->findAll();
        if (!$pessoaJuridicas) {
            throw new \Exception("PessoaJuridicas not found", 404);
        }
        return $pessoaJuridicas;
    }

    public function delete(int $id)
    {
        $pessoaJuridica = $this->findOne($id);
        $this->em->remove($pessoaJuridica);
        $this->em->flush();
    }

    public function findOne(int $id): PessoaJuridica
    {
        $pessoaJuridica = $this->em->getRepository('\App\Entity\PessoaJuridica')->find($id);
        if (!$pessoaJuridica) {
            throw new \Exception("PessoaJuridica not found", 404);
        }
        return $pessoaJuridica;
    }

    public function create($nome, $telefones, $enderecos, $email, $grupos, $nomeFantasia, $inscricaoEstadual, $numeroFuncionarios, $representanteLegal)
    {
        $pessoaJuridica = new PessoaJuridica();
        $pessoaJuridica->setNome($nome);
        $pessoaJuridica->setTelefones($telefones);
        $pessoaJuridica->setEnderecos($enderecos);
        $pessoaJuridica->setEmail($email);
        $pessoaJuridica->setGrupos($grupos);
        $pessoaJuridica->setNomeFantasia($nomeFantasia);
        $pessoaJuridica->setInscricaoEstadual($inscricaoEstadual);
        $pessoaJuridica->setNumeroFuncionarios($numeroFuncionarios);
        $pessoaJuridica->setRepresentanteLegal($representanteLegal);
        $this->em->persist($pessoaJuridica);
        $this->em->flush();
    }

    public function update(int $id, $nome, $telefones, $enderecos, $email, $grupos, $nomeFantasia, $inscricaoEstadual, $numeroFuncionarios, $representanteLegal)
    {
        $pessoaJuridica = $this->findOne($id);
        $pessoaJuridica->setNome($nome);
        $pessoaJuridica->setTelefones($telefones);
        $pessoaJuridica->setEnderecos($enderecos);
        $pessoaJuridica->setEmail($email);
        $pessoaJuridica->setGrupos($grupos);
        $pessoaJuridica->setNomeFantasia($nomeFantasia);
        $pessoaJuridica->setInscricaoEstadual($inscricaoEstadual);
        $pessoaJuridica->setNumeroFuncionarios($numeroFuncionarios);
        $pessoaJuridica->setRepresentanteLegal($representanteLegal);

        $this->em->persist($pessoaJuridica);
        $this->em->flush();
    }

}
