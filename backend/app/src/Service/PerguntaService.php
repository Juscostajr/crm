<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Pergunta;

class PerguntaService {

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

        $perguntas = $this->em->getRepository('\App\Entity\Pergunta')->findAll();



        if (!$perguntas) {
            throw new \Exception("Perguntas not found", 404);
        }

        return $perguntas;
    }

    public function findOne(int $id): Pergunta
    {
        $pergunta = $this->em->getRepository('\App\Entity\Pergunta')->find($id);

        if (!$pergunta) {
            throw new \Exception("Pergunta not found", 404);
        }

        return $pergunta;
    }

    public function delete(int $id)
    {
        $pergunta = $this->findOne($id);

        $this->em->remove($pergunta);
        $this->em->flush();
    }

    public function create($descricao, $checklist)
    {
        $pergunta = new Pergunta();
        $pergunta->setDescricao( $descricao);
        $pergunta->setChecklist( $checklist);


        $this->em->persist($pergunta);
        $this->em->flush();
    }

    public function update(int $id, $descricao, $checklist)
    {
        $pergunta = $this->findOne($id);

        $pergunta->setDescricao( $descricao);
$pergunta->setChecklist( $checklist);


        $this->em->persist($pergunta);
        $this->em->flush();
    }

}
