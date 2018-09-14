<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Grupo;

class GrupoService {

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
        $grupos = $this->em->getRepository('\App\Entity\Grupo')->findAll();

        if (!$grupos) {
            throw new \Exception("Grupos not found", 404);
        }

        return $grupos;
    }

    public function findOne(int $id): Grupo
    {
        $grupo = $this->em->getRepository('\App\Entity\Grupo')->find($id);

        if (!$grupo) {
            throw new \Exception("Grupo not found", 404);
        }

        return $grupo;
    }

    public function delete(int $id)
    {
        $grupo = $this->findOne($id);

        $this->em->remove($grupo);
        $this->em->flush();
    }

    public function create($tipo, $descricao, $membros)
    {
        $grupo = new Grupo();
        $grupo->setTipo( $tipo);
$grupo->setDescricao( $descricao);
$grupo->setMembros( $membros);


        $this->em->persist($grupo);
        $this->em->flush();
    }

    public function update(int $id, $tipo, $descricao, $membros)
    {
        $grupo = $this->findOne($id);

        $grupo->setTipo( $tipo);
$grupo->setDescricao( $descricao);
$grupo->setMembros( $membros);


        $this->em->persist($grupo);
        $this->em->flush();
    }

}
