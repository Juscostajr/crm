<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 29/09/2018
 * Time: 10:11
 */

namespace App\Factory;


use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\EntityManager;

class DoctrineJsonSerializator
{
    private $reflectionClass;
    private $instance;
    private $getters;
    private $resultArray;



    public function __construct($repository)
    {
        echo var_dump($repository);
        $realClass = ClassUtils::getRealClass(get_class($repository));
        $this->reflectionClass = new \ReflectionClass($realClass);
        $this->getters = $this->filterGetters($this->reflectionClass->getMethods());
        $this->instance = $repository;
    }

    public function getGetters(){
        return $this->getters;
    }
    public function getArray(){
       // $this->fillObjects();
       // $this->fillValues();
       // return $this->resultArray;
        return $this->reflectionClass->getName();
    }

    private function filterGetters($methods): array
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            return substr($method->getName(), 0, 3) == 'get';
        });
    }

    private function fillObjects()
    {
        foreach ($this->filterInstaces($this->getters) as $method) {
            $methodName = $method->getName();
            $serializer = new DoctrineJsonSerializator($this->instance->$methodName());
            $this->resultArray[$method->getParameters()[0]->getName()] = $serializer->getArray();
        }
    }

    private function fillValues()
    {
        foreach ($this->filterValues($this->getters) as $method) {
            $methodName = $method->getName();
            $this->resultArray[$method->getParameters()[0]->getName()] = $this->instance->$methodName();
        }
    }

    private function filterValues($methods)
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            $parameter = $method->getParameters()[0];
            return in_array($parameter->getType(), ['string', 'bool', 'int', 'float']);
        });
    }

    private function filterInstaces($methods)
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            return strpos($method->getParameters()[0]->getType(), 'Entity');
        });
    }

    private function filterArrays($methods)
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            return $method->getParameters()[0]->getType() == 'array';
        });
    }

}