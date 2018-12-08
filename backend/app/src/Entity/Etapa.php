<?php
namespace App\Entity;
class Etapa {
    const PROSPECTAR = 'Prospecção';
    const QUALIFICACAO = 'Qualificação';
    const APRESENTACAO = 'Apresentaçao';
    const AMADURECIMENTO = 'Amadurecimento';
    const NEGOCIACAO = 'Negociação';
    const FECHAMENTO = 'Fechamento';
    const CONSOLIDADA = 'Consolidada';

    private $value;

    public static function getAll(){
        return [self::PROSPECTAR,self::QUALIFICACAO,self::APRESENTACAO,self::AMADURECIMENTO,self::NEGOCIACAO,self::FECHAMENTO,self::CONSOLIDADA];
    }

}
?>