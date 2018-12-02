<?php
namespace App\Service;

use App\Entity\Pessoa;
use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;

class PessoaService
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

    public function addInteracao(int $id, DoctrineParamsMapper $interacao){
        $pessoa = $this->findOne($id);
        $pessoa->addInteracaos($interacao->map());
        $this->em->persist($pessoa);
        $this->em->flush();
    }
    public function findAll()
    {
        $pessoas = $this->em->getRepository('\App\Entity\Pessoa')->findAll();
        if (!$pessoas) {
            throw new \Exception("Pessoas not found", 404);
        }
        return $pessoas;
    }

    public function delete(int $id)
    {
        $pessoa = $this->findOne($id);
        $this->em->remove($pessoa);
        $this->em->flush();
    }

    public function findOne(int $id): Pessoa
    {
        $pessoa = $this->em->getRepository('\App\Entity\Pessoa')->find($id);
        if (!$pessoa) {
            throw new \Exception("Pessoa not found", 404);
        }
        return $pessoa;
    }

    public function findByName(array $name)
    {
        $pessoa = $this->em->getRepository('\App\Entity\Pessoa')->findBy($name);
        if (!$pessoa) {
            throw new \Exception("Pessoa not found", 404);
        }
        return $pessoa;
    }

    public function create(DoctrineParamsMapper $pessoa)
    {
        $this->em->persist($pessoa->map());
        $this->em->flush();
    }

    public function update(int $id, $razaoSocial, $telefones, $enderecos, $email, $grupos, $nomeFantasia, $inscricaoEstadual, $numeroFuncionarios, $representanteLegal)
    {
        $pessoa = $this->findOne($id);
        $pessoa->setRazaoSocial($razaoSocial);
        $pessoa->setTelefones($telefones);
        $pessoa->setEnderecos($enderecos);
        $pessoa->setEmail(new \App\Entity\Mail($email));
        $pessoa->setGrupos($grupos);
        $pessoa->setNomeFantasia($nomeFantasia);
        $pessoa->setInscricaoEstadual(new \App\Entity\InscricaoEstadual($inscricaoEstadual));
        $pessoa->setNumeroFuncionarios($numeroFuncionarios);
        $pessoa->setRepresentanteLegal($this->pf->findOne($representanteLegal));

        $this->em->persist($pessoa);
        $this->em->flush();
    }

}
