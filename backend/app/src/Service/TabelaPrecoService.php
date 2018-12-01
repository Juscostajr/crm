<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 24/11/2018
 * Time: 18:50
 */

namespace App\Service;


use App\Entity\TabelaPreco;
use Doctrine\ORM\EntityManager;

class TabelaPrecoService
{

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function findOne(int $id): TabelaPreco
    {
        /**
         * @var TabelaPreco $tabelaPreco
         */
        $tabelaPreco = $this->em->getRepository(TabelaPreco::class)->find($id);

        if (!$tabelaPreco) {
            throw new \Exception("Tabela not found", 404);
        }

        return $tabelaPreco;
    }

    public function delete(int $id)
    {
        $tabelaPreco = $this->findOne($id);
        $this->em->remove($tabelaPreco);
        $this->em->flush();
    }

    public function create($descricao, $valor)
    {
        $tabelaPreco = new TabelaPreco();
        $tabelaPreco->setDescricao( $descricao);
        $tabelaPreco->setValor( $valor);
        $this->em->persist($tabelaPreco);
        $this->em->flush();
    }

    public function update(int $id, $descricao, $valor)
    {
        /**
         * @var TabelaPreco $tabelaPreco
         */
        $tabelaPreco = $this->findOne($id);
        $tabelaPreco->setDescricao( $descricao);
        $tabelaPreco->setValor( $valor);
        $this->em->persist($tabelaPreco);
        $this->em->flush();
    }

}