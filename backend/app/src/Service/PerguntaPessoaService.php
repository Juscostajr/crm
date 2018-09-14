<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\PerguntaPessoa;

class PerguntaPessoaService {

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
        $perguntaPessoas = $this->em->getRepository('\App\Entity\PerguntaPessoa')->findAll();

        if (!$perguntaPessoas) {
            throw new \Exception("PerguntaPessoas not found", 404);
        }

        return $perguntaPessoas;
    }

    public function findOne(int $id): PerguntaPessoa
    {
        $perguntaPessoa = $this->em->getRepository('\App\Entity\PerguntaPessoa')->find($id);

        if (!$perguntaPessoa) {
            throw new \Exception("PerguntaPessoa not found", 404);
        }

        return $perguntaPessoa;
    }

    public function delete(int $id)
    {
        $perguntaPessoa = $this->findOne($id);

        $this->em->remove($perguntaPessoa);
        $this->em->flush();
    }

    public function create($pessoa, $pergunta, $resposta, $data)
    {
        $perguntaPessoa = new PerguntaPessoa();
        $perguntaPessoa->setPessoa( $pessoa);
$perguntaPessoa->setPergunta( $pergunta);
$perguntaPessoa->setResposta( $resposta);
$perguntaPessoa->setData( $data);


        $this->em->persist($perguntaPessoa);
        $this->em->flush();
    }

    public function update(int $id, $pessoa, $pergunta, $resposta, $data)
    {
        $perguntaPessoa = $this->findOne($id);

        $perguntaPessoa->setPessoa( $pessoa);
$perguntaPessoa->setPergunta( $pergunta);
$perguntaPessoa->setResposta( $resposta);
$perguntaPessoa->setData( $data);


        $this->em->persist($perguntaPessoa);
        $this->em->flush();
    }

}
