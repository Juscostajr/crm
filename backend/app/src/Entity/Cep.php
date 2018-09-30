<?php
namespace App\Entity;
class Cep {
    /**
     * @var string
     */
    private $numero;

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }


		
}
?>