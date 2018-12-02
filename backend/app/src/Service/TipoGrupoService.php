<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 24/11/2018
 * Time: 18:50
 */

namespace App\Service;


use App\Entity\TipoGrupo;
use Doctrine\ORM\EntityManager;

class TipoGrupoService
{

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function findOne(int $id): TipoGrupo
    {
        /**
         * @var TipoGrupo $tipoGrupo
         */
        $tipoGrupo = $this->em->getRepository(TipoGrupo::class)->find($id);

        if (!$tipoGrupo) {
            throw new \Exception("Tabela not found", 404);
        }

        return $tipoGrupo;
    }

    public function delete(int $id)
    {
        $tipoGrupo = $this->findOne($id);
        $this->em->remove($tipoGrupo);
        $this->em->flush();
    }

    public function create($descricao)
    {
        $tipoGrupo = new TipoGrupo();
        $tipoGrupo->setDescricao( $descricao);
        $this->em->persist($tipoGrupo);
        $this->em->flush();
    }

    public function update(int $id, $descricao)
    {
        /**
         * @var TipoGrupo $tipoGrupo
         */
        $tipoGrupo = $this->findOne($id);
        $tipoGrupo->setDescricao( $descricao);
        $this->em->persist($tipoGrupo);
        $this->em->flush();
    }

}