<?php
namespace App\Entity;
abstract class TipoTelefone {
    const FIXO = 'fixo';
    const MOVEL = 'móvel';
    const FAX = 'fax';

    public static function getAll(){
        return [self::FIXO,self::MOVEL,self::FAX];
    }
}
?>