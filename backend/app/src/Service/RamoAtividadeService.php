<?php
namespace App\Service;

use App\Entity\RamoAtividade;
use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;

class RamoAtividadeService
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
        $ramoAtividades = $this->em->getRepository('\App\Entity\RamoAtividade')->findAll();
        if (!$ramoAtividades) {
            throw new \Exception("RamoAtividades not found", 404);
        }
        return $ramoAtividades;
    }

    public function delete(int $id)
    {
        $ramoAtividade = $this->findOne($id);
        $this->em->remove($ramoAtividade);
        $this->em->flush();
    }

    public function findOne(int $id): RamoAtividade
    {
        $ramoAtividade = $this->em->getRepository('\App\Entity\RamoAtividade')->find($id);
        if (!$ramoAtividade) {
            throw new \Exception("RamoAtividade not found", 404);
        }
        return $ramoAtividade;
    }

    public function create(DoctrineParamsMapper $ramoAtividade)
    {
        $this->em->persist($ramoAtividade->map());
        $this->em->flush();
    }

    public function update(int $id, $razaoSocial, $telefones, $enderecos, $email, $grupos, $nomeFantasia, $inscricaoEstadual, $numeroFuncionarios, $representanteLegal)
    {
        $ramoAtividade = $this->findOne($id);
        $ramoAtividade->setRazaoSocial($razaoSocial);
        $ramoAtividade->setTelefones($telefones);
        $ramoAtividade->setEnderecos($enderecos);
        $ramoAtividade->setEmail(new \App\Entity\Mail($email));
        $ramoAtividade->setGrupos($grupos);
        $ramoAtividade->setNomeFantasia($nomeFantasia);
        $ramoAtividade->setInscricaoEstadual(new \App\Entity\InscricaoEstadual($inscricaoEstadual));
        $ramoAtividade->setNumeroFuncionarios($numeroFuncionarios);
        $ramoAtividade->setRepresentanteLegal($this->pf->findOne($representanteLegal));

        $this->em->persist($ramoAtividade);
        $this->em->flush();
    }

}
