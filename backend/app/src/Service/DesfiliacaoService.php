<?php
namespace App\Service;

use App\Entity\Desfiliacao;
use Doctrine\ORM\EntityManager;

class DesfiliacaoService
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
        $desfiliacaos = $this->em->getRepository('\App\Entity\Desfiliacao')->findAll();
        if (!$desfiliacaos) {
            throw new \Exception("Desfiliacaos not found", 404);
        }
        return $desfiliacaos;
    }

    public function delete(int $id)
    {
        $desfiliacao = $this->findOne($id);
        $this->em->remove($desfiliacao);
        $this->em->flush();
    }

    public function findOne(int $id): Desfiliacao
    {
        $desfiliacao = $this->em->getRepository('\App\Entity\Desfiliacao')->find($id);
        if (!$desfiliacao) {
            throw new \Exception("Desfiliacao not found", 404);
        }
        return $desfiliacao;
    }

    public function create($associado, $data, $motivo)
    {
        $desfiliacao = new Desfiliacao();
        $desfiliacao->setAssociado($associado);
        $desfiliacao->setData($data);
        $desfiliacao->setMotivo($motivo);
        $this->em->persist($desfiliacao);
        $this->em->flush();
    }

    public function update(int $id, $associado, $data, $motivos)
    {
        $desfiliacao = $this->findOne($id);
        $desfiliacao->setAssociado($associado);
        $desfiliacao->setData($data);
        $desfiliacao->setMotivos($motivos);
        $this->em->persist($desfiliacao);
        $this->em->flush();
    }

}
