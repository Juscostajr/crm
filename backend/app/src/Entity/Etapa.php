<?php
namespace App\Entity;
class Etapa {
    const PROSPECTAR = 'Prospecção';
    const QUALIFICACAO = 'Qualificação';
    const APRESENTACAO = 'Apresentaçao';
    const AMADURECIMENTO = 'Amadurecimento';
    const NEGOCIACAO = 'Negociacao';
    const FECHAMENTO = 'Fechamento';

    private $value;

    public static function getAll(){
        return [self::PROSPECTAR,self::QUALIFICACAO,self::APRESENTACAO,self::AMADURECIMENTO,self::NEGOCIACAO,self::FECHAMENTO];
    }

}
?>