<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Endereco;

class EnderecoService {

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
        $enderecos = $this->em->getRepository('\App\Entity\Endereco')->findAll();

        if (!$enderecos) {
            throw new \Exception("Enderecos not found", 404);
        }

        return $enderecos;
    }

    public function findOne(int $id): Endereco
    {
        $endereco = $this->em->getRepository('\App\Entity\Endereco')->find($id);

        if (!$endereco) {
            throw new \Exception("Endereco not found", 404);
        }

        return $endereco;
    }

    public function delete(int $id)
    {
        $endereco = $this->findOne($id);

        $this->em->remove($endereco);
        $this->em->flush();
    }

    public function create($cep, $nrImovel, $proprietario, $cidade, $logradouro, $complemento, $coordenadas, $bairro)
    {
        $endereco = new Endereco();
        $endereco->setCep( $cep);
$endereco->setNrImovel( $nrImovel);
$endereco->setProprietario( $proprietario);
$endereco->setCidade( $cidade);
$endereco->setLogradouro( $logradouro);
$endereco->setComplemento( $complemento);
$endereco->setCoordenadas( $coordenadas);
$endereco->setBairro( $bairro);


        $this->em->persist($endereco);
        $this->em->flush();
    }

    public function update(int $id, $cep, $nrImovel, $proprietario, $cidade, $logradouro, $complemento, $coordenadas, $bairro)
    {
        $endereco = $this->findOne($id);

        $endereco->setCep( $cep);
$endereco->setNrImovel( $nrImovel);
$endereco->setProprietario( $proprietario);
$endereco->setCidade( $cidade);
$endereco->setLogradouro( $logradouro);
$endereco->setComplemento( $complemento);
$endereco->setCoordenadas( $coordenadas);
$endereco->setBairro( $bairro);


        $this->em->persist($endereco);
        $this->em->flush();
    }

}
