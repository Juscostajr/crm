<?php
namespace App\Service;

use App\Entity\Associado;
use App\Entity\Desfiliacao;
use App\Entity\MotivoDesfiliacao;
use App\Factory\DoctrineParamsMapper;
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

    public function create(int $associado, string $data, string $motivo)
    {
        /**
         * @var Desfiliacao $d
         */
        $desfiliacao = new Desfiliacao();
        $associadoService = new AssociadoService($this->em);


        $desfiliacao->setAssociado($this->em->getReference(Associado::class, $associado));
        $desfiliacao->setData($data);
        $desfiliacao->setMotivo(new MotivoDesfiliacao($motivo));

        $associadoService->inactivate($desfiliacao->getAssociado()->getId());

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
