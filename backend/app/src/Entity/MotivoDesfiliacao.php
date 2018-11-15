<?php
namespace App\Entity;
use App\Factory\Enum;

class MotivoDesfiliacao extends Enum {

    protected $values =  array(
        'Insatisfação',
        'Fechamento',
        'Inutilização',
        'Financeiro',
        'Mudança de Cidade',
        'Desfiliação Estratégica',
        'Política'
    );

    public function __construct($value = null)
    {
        if(!is_null($value)) $this->setValue($value);
    }
}
?>