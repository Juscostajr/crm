<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="desfiliacao")
 */
class Desfiliacao
{

    /** @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Associado")
     * @ORM\JoinColumn(name="associado", referencedColumnName="id")
     */
    private $associado;

    /** @var \DateTime
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @var MotivoDesfiliacao $motivo
     * @ORM\Column(type="string")
     *
     */
    private $motivo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Associado
     */
    public function getAssociado(): Associado
    {
        return $this->associado;
    }

    /**
     * @param Associado $associado
     */
    public function setAssociado(Associado $associado)
    {
        $this->associado = $associado;
    }

    /**
     * @return \DateTime
     */
    public function getData(): string
    {
        return $this->data->format('d/m/Y');
    }

    /**
     * @param \DateTime $data
     */
    public function setData(string $data)
    {
        $this->data = new \DateTime($data);
    }

    /**
     * @return MotivoDesfiliacao
     */
    public function getMotivo(): string
    {
        return $this->motivo;
    }

    /**
     * @param MotivoDesfiliacao $motivo
     */
    public function setMotivo(MotivoDesfiliacao $motivo)
    {
        $this->motivo = $motivo->getValue();
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}

?>