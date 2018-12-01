<?php

namespace App\Service;

use App\Entity\Adesao;
use App\Entity\Associado;
use App\Entity\Pessoa;
use App\Entity\PessoaJuridica;
use App\Entity\Servico;
use App\Entity\StatusAssociado;
use App\Entity\TabelaPreco;
use Doctrine\ORM\EntityManager;

class AssociadoService
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
        $associados = $this->em->getRepository('\App\Entity\Associado')->findAll();

        if (!$associados) {
            throw new \Exception("Associados not found", 404);
        }

        return $associados;
    }

    public function delete(int $id)
    {
        $associado = $this->findOne($id);

        $this->em->remove($associado);
        $this->em->flush();
    }

    public function findOne(int $id): Associado
    {
        $associado = $this->em->getRepository('\App\Entity\Associado')->find($id);

        if (!$associado) {
            throw new \Exception("Associado not found", 404);
        }

        return $associado;
    }

    public function create($pessoaJuridica, $dataFiliacao, $statusAssociado, $valorMensalidade, $adesoes, $id)
    {
        $associado = is_null($id) ? new Associado() : $this->findOne($id);

        if(!is_null($id)){
        $this
            ->em
            ->createQueryBuilder()
            ->delete(Adesao::class, 'a')
            ->where('a.associado = :associado')
            ->setParameter('associado',$associado)
            ->getQuery()
            ->execute();
        }

        $associado->setPessoaJuridica($this->em->getReference(PessoaJuridica::class, $pessoaJuridica));
        $associado->setDataFiliacao($dataFiliacao);
        $associado->setStatusAssociado(new StatusAssociado($statusAssociado));
        $associado->setValorMensalidade($this->em->getReference(TabelaPreco::class, $valorMensalidade));

        foreach ($adesoes as $adesao){
            $objAdesao = new Adesao();
            $objAdesao->setData($dataFiliacao);
            $objAdesao->setAssociado($associado);
            $objAdesao->setServico($this->em->getReference(Servico::class, $adesao['id']));
            $associado->addAdesoes($objAdesao);
        }
        $this->em->persist($associado);
        $this->em->flush();
    }

    public function inactivate(int $id){
        $associado = $this->findOne($id);
        $associado->setStatusAssociado(new StatusAssociado('Inativo'));
        $this->em->persist($associado);
        $this->em->flush();
    }

    public function update(int $id, $pessoa, $dataFiliacao, $status, $valorMensalidade, $adesoes)
    {
        $associado = $this->findOne($id);

        $associado->setPessoa($pessoa);
        $associado->setDataFiliacao($dataFiliacao);
        $associado->setStatus($status);
        $associado->setValorMensalidade($valorMensalidade);
        $associado->setAdesoes($adesoes);


        $this->em->persist($associado);
        $this->em->flush();
    }

}
