<?php

namespace App\Service;

use App\Entity\Usuario;
use App\Factory\DoctrineParamsMapper;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;

class UsuarioService
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
        $usuarios = $this->em->getRepository('\App\Entity\Usuario')->findAll();

        if (!$usuarios) {
            throw new \Exception("Usuarios not found", 404);
        }

        return $usuarios;
    }

    public function delete(int $id)
    {
        $usuario = $this->findOne($id);

        $this->em->remove($usuario);
        $this->em->flush();
    }

    public function findOne(array $id): Usuario
    {
        $usuario = $this->em->getRepository('\App\Entity\Usuario')->findBy($id);

        if (!$usuario) {
            throw new \Exception("Usuario not found", 404);
        }

        return $usuario;
    }

    public function autenticate($args): Usuario
    {
        return $this->em->getRepository(Usuario::class)->findBy($args)[0];
    }

    public function create(DoctrineParamsMapper $usuario)
    {
        $this->em->persist($usuario->map());
        $this->em->flush();
    }

    public function getPermissions($id)
    {
        /**
         * @var Connection
         */
        $stmt = $this->em->getConnection()->prepare('SELECT a.entidade FROM crmanalytic.usuario u 
inner join crmanalytic.perfil_usuario pu on pu.usuario = u.id 
inner join crmanalytic.perfil_acesso pa on pa.perfil = pu.perfil 
inner join crmanalytic.acesso a on a.id = pa.acesso 
where u.id = ?');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();
        return array_map(function ($val) {
            return $val['entidade'];
        },$stmt->fetchAll());
    }

    public function update(int $id, $login, $pessoa, $senha, $perfis, $acoes)
    {
        $usuario = $this->findOne($id);

        $usuario->setLogin($login);
        $usuario->setPessoa($pessoa);
        $usuario->setSenha($senha);
        $usuario->setPerfis($perfis);
        $usuario->setAcoes($acoes);


        $this->em->persist($usuario);
        $this->em->flush();
    }

}
