<?php
namespace App\Entity;
class InscricaoEstadual {
    private $numero;

    /**
     * @return mixed
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }

		
}
?>