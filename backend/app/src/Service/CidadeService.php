<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Cidade;

class CidadeService {

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
        $cidades = $this->em->getRepository('\App\Entity\Cidade')->findAll();

        if (!$cidades) {
            throw new \Exception("Cidades not found", 404);
        }

        return $cidades;
    }

    public function findOne(int $id): Cidade
    {
        $cidade = $this->em->getRepository('\App\Entity\Cidade')->find($id);

        if (!$cidade) {
            throw new \Exception("Cidade not found", 404);
        }

        return $cidade;
    }

    public function delete(int $id)
    {
        $cidade = $this->findOne($id);

        $this->em->remove($cidade);
        $this->em->flush();
    }

    public function create($uf, $nome, $coordenadas)
    {
        $cidade = new Cidade();
        $cidade->setUf( $uf);
$cidade->setNome( $nome);
$cidade->setCoordenadas( $coordenadas);


        $this->em->persist($cidade);
        $this->em->flush();
    }

    public function update(int $id, $uf, $nome, $coordenadas)
    {
        $cidade = $this->findOne($id);

        $cidade->setUf( $uf);
$cidade->setNome( $nome);
$cidade->setCoordenadas( $coordenadas);


        $this->em->persist($cidade);
        $this->em->flush();
    }

}
