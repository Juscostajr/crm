<?php
namespace App\Entity;
use App\Factory\Enum;

class StatusAssociado extends Enum {
    protected  $values =  array(
        'Ativo',
        'Inativo'
    );

    /**
     * StatusAssociado constructor.
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }


}
?>