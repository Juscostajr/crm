<?php
namespace App\Service;

use App\Entity\Interacao;
use App\Factory\DoctrineParamsMapper;
use Doctrine\ORM\EntityManager;

class InteracaoService
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
        $interacaos = $this->em->getRepository('\App\Entity\Interacao')->findAll();
        if (!$interacaos) {
            throw new \Exception("Interacaos not found", 404);
        }
        return $interacaos;
    }

    public function delete(int $id)
    {
        $interacao = $this->findOne($id);
        $this->em->remove($interacao);
        $this->em->flush();
    }

    public function findOne(int $id): Interacao
    {
        $interacao = $this->em->getRepository('\App\Entity\Interacao')->find($id);
        if (!$interacao) {
            throw new \Exception("Interacao not found", 404);
        }
        return $interacao;
    }

    public function create(DoctrineParamsMapper $interacao)
    {
        $this->em->persist($interacao->map());
        $this->em->flush();
    }

    public function update(int $id, $feedback, $acao, $data, $hora, $tipo, $anotacoes, $pessoa, $usuario)
    {
        $interacao = $this->findOne($id);
        $interacao->setFeedback($feedback);
        $interacao->setAcao($acao);
        $interacao->setData($data);
        $interacao->setHora($hora);
        $interacao->setTipo($tipo);
        $interacao->setAnotacoes($anotacoes);
        $interacao->setPessoa($pessoa);
        $interacao->setUsuario($usuario);
        $this->em->persist($interacao);
        $this->em->flush();
    }

}
