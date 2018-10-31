<?php

namespace App\Service;

use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;
use App\Entity\Servico;

class ServicoService {

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
        $servicos = $this->em->getRepository('\App\Entity\Servico')->findAll();

        if (!$servicos) {
            throw new \Exception("Servicos not found", 404);
        }

        return $servicos;
    }

    public function findOne(int $id): Servico
    {
        $servico = $this->em->getRepository('\App\Entity\Servico')->find($id);

        if (!$servico) {
            throw new \Exception("Servico not found", 404);
        }

        return $servico;
    }

    public function delete(int $id)
    {
        $servico = $this->findOne($id);

        $this->em->remove($servico);
        $this->em->flush();
    }

    public function create(DoctrineParamsMapper $servico)
    {
        $this->em->persist($servico->map());
        $this->em->flush();
    }

    public function update(int $id, $descricao, $adesoes)
    {
        $servico = $this->findOne($id);

        $servico->setDescricao( $descricao);
$servico->setAdesoes( $adesoes);


        $this->em->persist($servico);
        $this->em->flush();
    }

}
