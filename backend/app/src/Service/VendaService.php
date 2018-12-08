<?php
namespace App\Service;

use App\Entity\Anotacao;
use App\Entity\Interacao;
use App\Entity\PessoaJuridica;
use App\Entity\Servico;
use App\Entity\Usuario;
use App\Entity\Venda;
use App\Factory\DoctrineParamsMapper;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
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

    public function create($etapa, $interacaos, $interesses, $pessoaJuridica)
    {
        /**
         * @var Venda
         */
        $venda = new Venda();
        $venda->cleanArrays();
        $venda->setEtapa($etapa);
        foreach ($interacaos as $interacao) {
            if (!array_key_exists('id', $interacao)) {
                $i = new Interacao();
                $i->setUsuario($this->em->getReference(Usuario::class, $interacao['usuario']['id']));
                $i->setData($interacao['data']);
                $i->setHora($interacao['hora']);
                $i->setTipo($interacao['tipo']);
                $i->setSentido($interacao['sentido']);

                foreach ($interacao['anotacaos'] as $anotacao) {
                    $a = new Anotacao();
                    if (!array_key_exists('id', $anotacao)) {
                        $a->setData($anotacao['data']);
                        $a->setHora($anotacao['hora']);
                        $a->setTitulo($anotacao['titulo']);
                        $a->setDescricao($anotacao['descricao']);
                        $i->addAnotacaos($a);
                    }

                }
                $venda->addInteracaos($i);
            }
        }

        foreach ($interesses as $interesse) {
            $venda->addInteresses($this->em->getReference(Servico::class, $interesse['id']));
        }

        $venda->setPessoaJuridica($this->em->getReference(PessoaJuridica::class, $pessoaJuridica['id']));
        $this->em->persist($venda);
        $this->em->flush();
    }

    public function findNaoAssociados()
    {

        $stmt = $this->em->getConnection()->prepare("
        SELECT * FROM crmanalytic.pessoa p
INNER JOIN crmanalytic.endereco_pessoa ep ON ep.pessoa = p.id
INNER JOIN crmanalytic.endereco e ON e.id = ep.endereco 
INNER JOIN crmanalytic.coordenadas c ON c.id = e.coordenadas
WHERE p.id NOT IN (
	SELECT pessoaJuridica 
	FROM crmanalytic.associado a
	WHERE a.statusAssociado = 'Ativo')
AND p.tipo = 'pj' 
ORDER BY e.bairro, e.logradouro, e.nrImovel");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update(int $id, $etapa, $interacaos, $interesses, $pessoaJuridica)
    {
        /**
         * @var Venda
         */
        $venda = $this->em->find(Venda::class, $id);
        $venda->cleanArrays();
        $venda->setEtapa($etapa);
        foreach ($interacaos as $interacao) {
            if (!array_key_exists('id', $interacao)) {
                $i = new Interacao();
                $i->setUsuario($this->em->getReference(Usuario::class, $interacao['usuario']['id']));
                $i->setData($interacao['data']);
                $i->setHora($interacao['hora']);
                $i->setTipo($interacao['tipo']);
                $i->setSentido($interacao['sentido']);

                foreach ($interacao['anotacaos'] as $anotacao) {
                    $a = new Anotacao();
                    if (!array_key_exists('id', $anotacao)) {
                        $a->setData($anotacao['data']);
                        $a->setHora($anotacao['hora']);
                        $a->setTitulo($anotacao['titulo']);
                        $a->setDescricao($anotacao['descricao']);
                        $i->addAnotacaos($a);
                    }

                }
                $venda->addInteracaos($i);
            }
        }

        foreach ($interesses as $interesse) {
            $venda->addInteresses($this->em->getReference(Servico::class, $interesse['id']));
        }

        $venda->setPessoaJuridica($this->em->getReference(PessoaJuridica::class, $pessoaJuridica['id']));
        $this->em->merge($venda);
        $this->em->flush();
    }

}
