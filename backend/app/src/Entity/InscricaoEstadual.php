<?php
namespace App\Entity;
class InscricaoEstadual {
    private $numero;
    public function __construct(string $numero)
    {
        $this->numero = $numero;
    }
		
}
?>