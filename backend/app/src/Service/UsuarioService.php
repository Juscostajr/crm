<?php

namespace App\Service;

use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;
use App\Entity\Usuario;

class UsuarioService {

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
        $usuarios = $this->em->getRepository('\App\Entity\Usuario')->findAll();

        if (!$usuarios) {
            throw new \Exception("Usuarios not found", 404);
        }

        return $usuarios;
    }

    public function findOne(int $id): Usuario
    {
        $usuario = $this->em->getRepository('\App\Entity\Usuario')->find($id);

        if (!$usuario) {
            throw new \Exception("Usuario not found", 404);
        }

        return $usuario;
    }

    public function delete(int $id)
    {
        $usuario = $this->findOne($id);

        $this->em->remove($usuario);
        $this->em->flush();
    }

    public function create(DoctrineParamsMapper $usuario)
    {
        $this->em->persist($usuario->map());
        $this->em->flush();
    }

    public function update(int $id, $login, $pessoa, $senha, $perfis, $acoes)
    {
        $usuario = $this->findOne($id);

        $usuario->setLogin( $login);
$usuario->setPessoa( $pessoa);
$usuario->setSenha( $senha);
$usuario->setPerfis( $perfis);
$usuario->setAcoes( $acoes);


        $this->em->persist($usuario);
        $this->em->flush();
    }

}
