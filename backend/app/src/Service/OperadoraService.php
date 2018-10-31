<?php

namespace App\Service;

use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;
use App\Entity\Operadora;

class OperadoraService {

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
        $operadoras = $this->em->getRepository('\App\Entity\Operadora')->findAll();

        if (!$operadoras) {
            throw new \Exception("Operadoras not found", 404);
        }

        return $operadoras;
    }

    public function findOne(int $id): Operadora
    {
        $operadora = $this->em->getRepository('\App\Entity\Operadora')->find($id);

        if (!$operadora) {
            throw new \Exception("Operadora not found", 404);
        }

        return $operadora;
    }

    public function delete(int $id)
    {
        $operadora = $this->findOne($id);

        $this->em->remove($operadora);
        $this->em->flush();
    }

    public function create(DoctrineParamsMapper $operadora)
    {
        $this->em->persist($operadora->map());
        $this->em->flush();
    }

    public function update(int $id, $nome)
    {
        $operadora = $this->findOne($id);

        $operadora->setNome( $nome);


        $this->em->persist($operadora);
        $this->em->flush();
    }

}
