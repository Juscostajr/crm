<?php

namespace App\Service;

use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;
use App\Entity\Perfil;

class PerfilService {

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
        $perfils = $this->em->getRepository('\App\Entity\Perfil')->findAll();

        if (!$perfils) {
            throw new \Exception("Perfils not found", 404);
        }

        return $perfils;
    }

    public function findOne(int $id): Perfil
    {
        $perfil = $this->em->getRepository('\App\Entity\Perfil')->find($id);

        if (!$perfil) {
            throw new \Exception("Perfil not found", 404);
        }

        return $perfil;
    }

    public function delete(int $id)
    {
        $perfil = $this->findOne($id);

        $this->em->remove($perfil);
        $this->em->flush();
    }

    public function create(DoctrineParamsMapper $perfil)
    {
        $this->em->persist($perfil->map());
        $this->em->flush();
    }

    public function update(int $id, $acessos, $descricao, $usuario)
    {
        $perfil = $this->findOne($id);

        $perfil->setAcessos( $acessos);
$perfil->setDescricao( $descricao);
$perfil->setUsuario( $usuario);


        $this->em->persist($perfil);
        $this->em->flush();
    }

}
