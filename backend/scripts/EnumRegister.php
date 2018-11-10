<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 02/11/2018
 * Time: 11:21
 */
require './vendor/autoload.php';

echo "Informe o tipo a ser criado!\n";
$tipo = fgets(fopen ("php://stdin","r"));

echo "Informe a entidade que o representa!\n";
$entidade = fgets(fopen ("php://stdin","r"));
\Doctrine\DBAL\Types\Type::addType($tipo,"App\\Entity\\$entidade");

print_r(\Doctrine\DBAL\Types\Type::getTypesMap());
