<?php
namespace App\Service;

use App\Entity\Anotacao;
use App\Entity\Interacao;
use App\Entity\PessoaJuridica;
use App\Entity\Servico;
use App\Entity\Usuario;
use App\Entity\Venda;
use App\Factory\DoctrineParamsMapper;
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

    public function create(DoctrineParamsMapper $venda)
    {
        $this->em->merge($venda->map());
        $this->em->flush();
    }

    public function update(int $id, $etapa, $interacaos, $interesses, $pessoaJuridica)
    {
        $venda = $this->findOne($id);
        $venda->setEtapa($etapa);
        foreach ($interacaos as $interacao){
            $i = new Interacao();
            if (array_key_exists ( 'id' , $interacao )){
                $i = $this->em->getReference(Interacao::class,$interacao['id']);
            } else {
                $i->setUsuario($this->em->getReference(Usuario::class, $interacao['usuario']['id']));
                $i->setData($interacao['data']);
                $i->setHora($interacao['hora']);
                $i->setTipo($interacao['tipo']);
            }

            foreach ($interacao['anotacaos'] as $anotacao){
                $a = new Anotacao();
                if (array_key_exists ( 'id' , $anotacao )){
                    $a = $this->em->getReference(Anotacao::class,$anotacao['id']);
                } else {
                    $a->setData($anotacao['data']);
                    $a->setHora($anotacao['hora']);
                    $a->setTitulo($anotacao['titulo']);
                    $a->setDescricao($anotacao['descricao']);
                }
                $i->addAnotacaos($a);
            }

            $venda->addInteracaos($i);
        }
        echo var_dump($venda->getInteresses());
        foreach ($interesses as $interesse){



            $eee = array_map(function($val){
                return $val['id'];
            }, (array) $venda->getInteresses());

            if(!array_search($interesse['id'], $eee)){
                echo $interesse['id'];
                $venda->addInteresses($this->em->getReference(Servico::class,$interesse['id']));
            };

        }

        $venda->setPessoaJuridica($this->em->getReference(PessoaJuridica::class,$pessoaJuridica['id']));
        $this->em->persist($venda);
        $this->em->flush();
    }

}
