<?php

namespace App\Service;

use App\Entity\Acesso;
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

    public function create($id, $acessos, $descricao)
    {
        $perfil = $this->em->getRepository(Perfil::class)->find($id);
        $perfil->setDescricao($descricao);
        foreach ($acessos as $acesso)
        {
            if($this->em->getRepository(Acesso::class)->find(isset($acesso['id']) ?? 0)){
                continue;
            }
            $obj =  new Acesso();
            $obj->setRota($acesso['rota']);
            $obj->setGet($acesso['GET']);
            $obj->setPosta($acesso['POST']);
            $obj->setPut($acesso['PUT']);
            $obj->setDelete($acesso['DELETE']);
            $perfil->addAcesso($obj);
        }
        $this->em->merge($perfil);
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
