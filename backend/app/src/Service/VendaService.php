<?php
namespace App\Service;

use App\Entity\Venda;
use Doctrine\ORM\EntityManager;

class VendaService
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
        $vendas = $this->em->getRepository('\App\Entity\Venda')->findAll();
        if (!$vendas) {
            throw new \Exception("Vendas not found", 404);
        }
        return $vendas;
    }

    public function delete(int $id)
    {
        $venda = $this->findOne($id);
        $this->em->remove($venda);
        $this->em->flush();
    }

    public function findOne(int $id): Venda
    {
        $venda = $this->em->getRepository('\App\Entity\Venda')->find($id);
        if (!$venda) {
            throw new \Exception("Venda not found", 404);
        }
        return $venda;
    }

    public function create($etapa, $interesses, $data, $hora, $pessoa, $usuario)
    {
        $venda = new Venda();
        $venda->setEtapa($etapa);
        $venda->setInteresses($interesses);
        $venda->setData($data);
        $venda->setHora($hora);
        $venda->setPessoa($pessoa);
        $venda->setUsuario($usuario);
        $this->em->persist($venda);
        $this->em->flush();
    }

    public function update(int $id, $etapa, $interesses, $data, $hora, $pessoa, $usuario)
    {
        $venda = $this->findOne($id);
        $venda->setEtapa($etapa);
        $venda->setInteresses($interesses);
        $venda->setData($data);
        $venda->setHora($hora);
        $venda->setPessoa($pessoa);
        $venda->setUsuario($usuario);
        $this->em->persist($venda);
        $this->em->flush();
    }

}
