<?php

namespace App\Service;

use App\Entity\Campanha;
use App\Entity\Pergunta;
use App\Entity\PerguntaPessoa;
use App\Entity\Pessoa;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

class PerguntaPessoaService
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
        $perguntaPessoas = $this->em->getRepository('\App\Entity\PerguntaPessoa')->findAll();

        if (!$perguntaPessoas) {
            throw new \Exception("PerguntaPessoas not found", 404);
        }

        return $perguntaPessoas;
    }

    public function findByCampanha(Campanha $campanha, Pessoa $pessoa)
    {
        $qb = $this->em
            ->createQueryBuilder()
            ->select('pp')
            ->from(PerguntaPessoa::class, 'pp')
            ->innerJoin('pp.pergunta', 'p')
            ->where('p.campanha = ?1')
            ->andWhere('pp.pessoa = ?2');
        $qb->setParameters(array(1 => $campanha->getId(), 2 => $pessoa->getId()));
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function delete(int $id)
    {
        $perguntaPessoa = $this->findOne($id);

        $this->em->remove($perguntaPessoa);
        $this->em->flush();
    }

    public function findOne(int $idPergunta, int $idPessoa): PerguntaPessoa
    {

        $perguntaPessoa = $this->em->getRepository('\App\Entity\PerguntaPessoa')->findOneBy(['pessoa' => $idPessoa, 'pergunta' => $idPergunta]);

        if (!$perguntaPessoa) {
            throw new NoResultException();
        }

        return $perguntaPessoa;
    }

    public function createOrUpdate($pessoa, $pergunta, $resposta, $data)
    {
        try {
            $perguntaPessoa = $this->findOne($pergunta, $pessoa);
        } catch (NoResultException $ex) {
            $perguntaPessoa = new PerguntaPessoa();
            $perguntaPessoa->setPessoa($this->em->getReference(Pessoa::class, $pessoa));
            $perguntaPessoa->setPergunta($this->em->getReference(Pergunta::class, $pergunta));
        } finally {
            $perguntaPessoa->setResposta($resposta);
            $perguntaPessoa->setData($data);

            $this->em->persist($perguntaPessoa);
            $this->em->flush();
        }
    }

    public function update(int $id, $pessoa, $pergunta, $resposta, $data)
    {
        $perguntaPessoa = $this->findOne($id);

        $perguntaPessoa->setPessoa($pessoa);
        $perguntaPessoa->setPergunta($pergunta);
        $perguntaPessoa->setResposta($resposta);
        $perguntaPessoa->setData($data);


        $this->em->persist($perguntaPessoa);
        $this->em->flush();
    }

}
