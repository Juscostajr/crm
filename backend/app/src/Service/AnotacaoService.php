<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Anotacao;

class AnotacaoService {

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
        $anotacaos = $this->em->getRepository('\App\Entity\Anotacao')->findAll();

        if (!$anotacaos) {
            throw new \Exception("Anotacaos not found", 404);
        }

        return $anotacaos;
    }

    public function findOne(int $id): Anotacao
    {
        $anotacao = $this->em->getRepository('\App\Entity\Anotacao')->find($id);

        if (!$anotacao) {
            throw new \Exception("Anotacao not found", 404);
        }

        return $anotacao;
    }

    public function delete(int $id)
    {
        $anotacao = $this->findOne($id);

        $this->em->remove($anotacao);
        $this->em->flush();
    }

    public function create($data, $hora, $descricao, $interacao)
    {
        $anotacao = new Anotacao();
        $anotacao->setData( $data);
$anotacao->setHora( $hora);
$anotacao->setDescricao( $descricao);
$anotacao->setInteracao( $interacao);


        $this->em->persist($anotacao);
        $this->em->flush();
    }

    public function update(int $id, $data, $hora, $descricao, $interacao)
    {
        $anotacao = $this->findOne($id);

        $anotacao->setData( $data);
$anotacao->setHora( $hora);
$anotacao->setDescricao( $descricao);
$anotacao->setInteracao( $interacao);


        $this->em->persist($anotacao);
        $this->em->flush();
    }

}
