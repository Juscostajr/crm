<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Associado;

class AssociadoService {

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
        $associados = $this->em->getRepository('\App\Entity\Associado')->findAll();

        if (!$associados) {
            throw new \Exception("Associados not found", 404);
        }

        return $associados;
    }

    public function findOne(int $id): Associado
    {
        $associado = $this->em->getRepository('\App\Entity\Associado')->find($id);

        if (!$associado) {
            throw new \Exception("Associado not found", 404);
        }

        return $associado;
    }

    public function delete(int $id)
    {
        $associado = $this->findOne($id);

        $this->em->remove($associado);
        $this->em->flush();
    }

    public function create($pessoa, $dataFiliacao, $status, $valorMensalidade, $adesoes)
    {
        $associado = new Associado();
        $associado->setPessoa( $pessoa);
$associado->setDataFiliacao( $dataFiliacao);
$associado->setStatus( $status);
$associado->setValorMensalidade( $valorMensalidade);
$associado->setAdesoes( $adesoes);


        $this->em->persist($associado);
        $this->em->flush();
    }

    public function update(int $id, $pessoa, $dataFiliacao, $status, $valorMensalidade, $adesoes)
    {
        $associado = $this->findOne($id);

        $associado->setPessoa( $pessoa);
$associado->setDataFiliacao( $dataFiliacao);
$associado->setStatus( $status);
$associado->setValorMensalidade( $valorMensalidade);
$associado->setAdesoes( $adesoes);


        $this->em->persist($associado);
        $this->em->flush();
    }

}
