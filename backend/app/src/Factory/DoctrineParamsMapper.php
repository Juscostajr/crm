<?php

/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 22/09/2018
 * Time: 14:49
 */
namespace App\Factory;

use Doctrine\ORM\EntityManager;

class DoctrineParamsMapper
{
    private $primaryKey;
    private $reflectionClass;
    private $inputData;
    private $validMethods;
    private $setters;
    private $addables;
    private $instance;
    private $em;

    public function __construct($referenceClass, $inputData, EntityManager $em)
    {
        $this->em = $em;
        $this->reflectionClass = new \ReflectionClass($referenceClass);
        $this->primaryKey = $this->findPk($this->reflectionClass);
        $this->inputData = $inputData;
        $this->validMethods = $this->filterValids();
        $this->setters = $this->filterSetters($this->validMethods);
        $this->addables = $this->filterAddables($this->validMethods);
        $this->instance = new $referenceClass();
    }

    private function findPk(\ReflectionClass $class)
    {
        foreach ($class->getProperties() as $property) {
            if ($property->getName() == 'id') return 'id';
            if (stripos($property->getDocComment(), '@ORM\Id')) return $property->getName();
        }
        return 'weakEntity';
    }

    private function filterSetters($methods): array
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            return substr($method->getName(), 0, 3) == 'set';
        });
    }

    private function filterValids(): array
    {
        return array_filter($this->reflectionClass->getMethods(), function (\ReflectionMethod $method) {
            if (!isset($method->getParameters()[0])) return false;
            $key = (string)$method->getParameters()[0]->getName();
            return isset($this->inputData[$key]) || isset($this->inputData[$key . 's']);
        });
    }

    private function filterAddables($methods): array
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            return substr($method->getName(), 0, 3) == 'add';
        });
    }

    public function map()
    {
        echo $this->reflectionClass->getName() . "\n";
        if ($this->isReference()) {
            return $this->em->getReference($this->reflectionClass->getName(), $this->inputData[$this->primaryKey]);
        }
        $this->fillValues();
        $this->fillObjects();
        $this->fillArrays();

        return $this->instance;
    }


    private function fillValues()
    {
        foreach ($this->filterValues($this->setters) as $method) {
            $name = $method->getName();
            $this->instance->$name($this->inputData[$method->getParameters()[0]->getName()]);
        }
    }

    private function fillArrays()
    {
        foreach ($this->addables as $method) {
            $methodName = $method->getParameters()[0]->getName() . 's';
            if (!array_key_exists($methodName, $this->inputData)) continue;
            foreach ($this->inputData[$methodName] as $data) {
                $v = new DoctrineParamsMapper(
                    (string)$method->getParameters()[0]->getType(),
                    $data,
                    $this->em
                );
                $n = $method->getName();
                $this->instance->$n($v->map());
            }
        }
    }

    private function fillObjects()
    {
        foreach ($this->filterInstaces($this->setters) as $method) {
            $methodName = $method->getName();
            $dpm = new DoctrineParamsMapper(
                (string)$method->getParameters()[0]->getType(),
                $this->inputData[$method->getParameters()[0]->getName()],
                $this->em
            );
            echo var_dump($this->inputData[$method->getParameters()[0]->getName()]);
            $this->instance->$methodName($dpm->map());
        }
    }

    private function filterValues($methods)
    {
        return array_filter($methods, function (\ReflectionMethod $method) {
            $parameter = $method->getParameters()[0];
            return in_array($parameter->getType(), ['string', 'bool', 'int', 'float'])
                && $parameter->getName() != $this->primaryKey;
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

    private function isReference(): bool
    {
        return isset($this->inputData[$this->primaryKey]);
    }

}