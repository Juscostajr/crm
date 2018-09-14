<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\CheckList;

class CheckListService {

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
        $checkLists = $this->em->getRepository('\App\Entity\CheckList')->findAll();

        if (!$checkLists) {
            throw new \Exception("CheckLists not found", 404);
        }

        return $checkLists;
    }

    public function findOne(int $id): CheckList
    {
        $checkList = $this->em->getRepository('\App\Entity\CheckList')->find($id);

        if (!$checkList) {
            throw new \Exception("CheckList not found", 404);
        }

        return $checkList;
    }

    public function delete(int $id)
    {
        $checkList = $this->findOne($id);

        $this->em->remove($checkList);
        $this->em->flush();
    }

    public function create($perguntas, $grupo)
    {
        $checkList = new CheckList();
        $checkList->setPerguntas( $perguntas);
$checkList->setGrupo( $grupo);


        $this->em->persist($checkList);
        $this->em->flush();
    }

    public function update(int $id, $perguntas, $grupo)
    {
        $checkList = $this->findOne($id);

        $checkList->setPerguntas( $perguntas);
$checkList->setGrupo( $grupo);


        $this->em->persist($checkList);
        $this->em->flush();
    }

}
