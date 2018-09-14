<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Coordenadas;

class CoordenadasService {

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
        $coordenadass = $this->em->getRepository('\App\Entity\Coordenadas')->findAll();

        if (!$coordenadass) {
            throw new \Exception("Coordenadass not found", 404);
        }

        return $coordenadass;
    }

    public function findOne(int $id): Coordenadas
    {
        $coordenadas = $this->em->getRepository('\App\Entity\Coordenadas')->find($id);

        if (!$coordenadas) {
            throw new \Exception("Coordenadas not found", 404);
        }

        return $coordenadas;
    }

    public function delete(int $id)
    {
        $coordenadas = $this->findOne($id);

        $this->em->remove($coordenadas);
        $this->em->flush();
    }

    public function create($latitude, $longitude)
    {
        $coordenadas = new Coordenadas();
        $coordenadas->setLatitude( $latitude);
$coordenadas->setLongitude( $longitude);


        $this->em->persist($coordenadas);
        $this->em->flush();
    }

    public function update(int $id, $latitude, $longitude)
    {
        $coordenadas = $this->findOne($id);

        $coordenadas->setLatitude( $latitude);
$coordenadas->setLongitude( $longitude);


        $this->em->persist($coordenadas);
        $this->em->flush();
    }

}
