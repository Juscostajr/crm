<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Telefone;

class TelefoneService {

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
        $telefones = $this->em->getRepository('\App\Entity\Telefone')->findAll();

        if (!$telefones) {
            throw new \Exception("Telefones not found", 404);
        }

        return $telefones;
    }

    public function findOne(int $id): Telefone
    {
        $telefone = $this->em->getRepository('\App\Entity\Telefone')->find($id);

        if (!$telefone) {
            throw new \Exception("Telefone not found", 404);
        }

        return $telefone;
    }

    public function delete(int $id)
    {
        $telefone = $this->findOne($id);

        $this->em->remove($telefone);
        $this->em->flush();
    }

    public function create($numero, $proprietario, $operadora, $tipo)
    {
        $telefone = new Telefone();
        $telefone->setNumero( $numero);
$telefone->setProprietario( $proprietario);
$telefone->setOperadora( $operadora);
$telefone->setTipo( $tipo);


        $this->em->persist($telefone);
        $this->em->flush();
    }

    public function update(int $id, $numero, $proprietario, $operadora, $tipo)
    {
        $telefone = $this->findOne($id);

        $telefone->setNumero( $numero);
$telefone->setProprietario( $proprietario);
$telefone->setOperadora( $operadora);
$telefone->setTipo( $tipo);


        $this->em->persist($telefone);
        $this->em->flush();
    }

}
