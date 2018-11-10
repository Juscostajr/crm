<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 02/11/2018
 * Time: 10:14
 */

namespace App\Entity;


use App\Factory\Enum;

class Sentido extends Enum
{
    protected  $values =  array(
        'in',
        'out'
    );

    public function __construct (string $sentido){
        $this->setValue($sentido);
    }


}