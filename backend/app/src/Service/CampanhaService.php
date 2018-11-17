<?php
namespace App\Service;

use App\Entity\Campanha;
use App\Entity\Grupo;
use App\Entity\Pergunta;
use App\Entity\Pessoa;
use App\Entity\Servico;
use Doctrine\ORM\EntityManager;

class CampanhaService
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
        $campanhas = $this->em->getRepository('\App\Entity\Campanha')->findAll();
        if (!$campanhas) {
            throw new \Exception("Campanhas not found", 404);
        }
        return $campanhas;
    }

    public function delete(int $id)
    {
        $campanha = $this->findOne($id);
        $this->em->remove($campanha);
        $this->em->flush();
    }

    public function findOne(int $id): Campanha
    {
        $campanha = $this->em->getRepository('\App\Entity\Campanha')->find($id);
        if (!$campanha) {
            throw new \Exception("Campanha not found", 404);
        }
        return $campanha;
    }

    public function create($servico, $target, $nome, $descricao, $inicio, $final)
    {
        $campanha = new Campanha();
        $campanha->setServico($this->em->getReference(Servico::class,$servico));
        $campanha->setTarget($this->em->getReference(Grupo::class,$target));
        $campanha->setNome($nome);
        $campanha->setDescricao($descricao);
        $campanha->setInicio($inicio);
        $campanha->setFinal($final);
        $this->em->persist($campanha);
        $this->em->flush();
    }

    public function addPerguntas($id, $perguntas)
    {
        $campanha = $this->findOne($id);

        foreach ($perguntas as $pergunta){
            $objPergunta = new Pergunta();
            $objPergunta->setDescricao($pergunta['descricao']);
            $objPergunta->setCampanha($campanha);
            $campanha->addPergunta($objPergunta);
        }
        $this->em->persist($campanha);
        $this->em->flush();
    }



    public function update(int $id, $target, $feedback, $nome, $descricao, $inicio, $final, $usuario, $pessoa)
    {
        $campanha = $this->findOne($id);
        $campanha->setTarget($target);
        $campanha->setFeedback($feedback);
        $campanha->setNome($nome);
        $campanha->setDescricao($descricao);
        $campanha->setInicio($inicio);
        $campanha->setFinal($final);
        $campanha->setUsuario($usuario);
        $campanha->setPessoa($pessoa);
        $this->em->persist($campanha);
        $this->em->flush();
    }

}
