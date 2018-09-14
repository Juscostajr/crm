<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Uf;

class UfService {

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
        $ufs = $this->em->getRepository('\App\Entity\Uf')->findAll();

        if (!$ufs) {
            throw new \Exception("Ufs not found", 404);
        }

        return $ufs;
    }

    public function findOne(int $id): Uf
    {
        $uf = $this->em->getRepository('\App\Entity\Uf')->find($id);

        if (!$uf) {
            throw new \Exception("Uf not found", 404);
        }

        return $uf;
    }

    public function delete(int $id)
    {
        $uf = $this->findOne($id);

        $this->em->remove($uf);
        $this->em->flush();
    }

    public function create($sigla, $nome)
    {
        $uf = new Uf();
        $uf->setSigla( $sigla);
$uf->setNome( $nome);


        $this->em->persist($uf);
        $this->em->flush();
    }

    public function update(int $id, $sigla, $nome)
    {
        $uf = $this->findOne($id);

        $uf->setSigla( $sigla);
$uf->setNome( $nome);


        $this->em->persist($uf);
        $this->em->flush();
    }

}
