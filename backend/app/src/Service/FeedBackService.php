<?php

namespace App\Service;

use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;
use App\Entity\FeedBack;

class FeedBackService {

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
        $feedBacks = $this->em->getRepository('\App\Entity\FeedBack')->findAll();

        if (!$feedBacks) {
            throw new \Exception("FeedBacks not found", 404);
        }

        return $feedBacks;
    }

    public function findOne(int $id): FeedBack
    {
        $feedBack = $this->em->getRepository('\App\Entity\FeedBack')->find($id);

        if (!$feedBack) {
            throw new \Exception("FeedBack not found", 404);
        }

        return $feedBack;
    }

    public function delete(int $id)
    {
        $feedBack = $this->findOne($id);

        $this->em->remove($feedBack);
        $this->em->flush();
    }

    public function create(DoctrineParamsMapper $feedback)
    {
        $this->em->persist($feedback->map());
        $this->em->flush();
    }

    public function update(int $id, $justificativa, $data, $indicador, $hora, $observacao)
    {
        $feedBack = $this->findOne($id);

        $feedBack->setJustificativa( $justificativa);
$feedBack->setData( $data);
$feedBack->setIndicador( $indicador);
$feedBack->setHora( $hora);
$feedBack->setObservacao( $observacao);


        $this->em->persist($feedBack);
        $this->em->flush();
    }

}
