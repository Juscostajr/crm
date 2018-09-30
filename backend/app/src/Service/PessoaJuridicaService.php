<?php
namespace App\Service;

use App\Entity\PessoaJuridica;
use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;

class PessoaJuridicaService
{

    /**
     * @var EntityManager
     */
    protected $em;
    private $pf;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->pf = new PessoaFisicaService($em);
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

    public function create(DoctrineParamsMapper $pessoaJuridica)
    {
        $this->em->persist($pessoaJuridica->map());
        $this->em->flush();
    }

    public function update(int $id, $razaoSocial, $telefones, $enderecos, $email, $grupos, $nomeFantasia, $inscricaoEstadual, $numeroFuncionarios, $representanteLegal)
    {
        $pessoaJuridica = $this->findOne($id);
        $pessoaJuridica->setRazaoSocial($razaoSocial);
        $pessoaJuridica->setTelefones($telefones);
        $pessoaJuridica->setEnderecos($enderecos);
        $pessoaJuridica->setEmail(new \App\Entity\Mail($email));
        $pessoaJuridica->setGrupos($grupos);
        $pessoaJuridica->setNomeFantasia($nomeFantasia);
        $pessoaJuridica->setInscricaoEstadual(new \App\Entity\InscricaoEstadual($inscricaoEstadual));
        $pessoaJuridica->setNumeroFuncionarios($numeroFuncionarios);
        $pessoaJuridica->setRepresentanteLegal($this->pf->findOne($representanteLegal));

        $this->em->persist($pessoaJuridica);
        $this->em->flush();
    }

}
