<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Adesao;

class AdesaoService {

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
        $adesaos = $this->em->getRepository('\App\Entity\Adesao')->findAll();

        if (!$adesaos) {
            throw new \Exception("Adesaos not found", 404);
        }

        return $adesaos;
    }

    public function findOne(int $id): Adesao
    {
        $adesao = $this->em->getRepository('\App\Entity\Adesao')->find($id);

        if (!$adesao) {
            throw new \Exception("Adesao not found", 404);
        }

        return $adesao;
    }

    public function delete(int $id)
    {
        $adesao = $this->findOne($id);

        $this->em->remove($adesao);
        $this->em->flush();
    }

    public function create($data, $servico, $associado)
    {
        $adesao = new Adesao();
        $adesao->setData( $data);
$adesao->setServico( $servico);
$adesao->setAssociado( $associado);


        $this->em->persist($adesao);
        $this->em->flush();
    }

    public function update(int $id, $data, $servico, $associado)
    {
        $adesao = $this->findOne($id);

        $adesao->setData( $data);
$adesao->setServico( $servico);
$adesao->setAssociado( $associado);


        $this->em->persist($adesao);
        $this->em->flush();
    }

}
