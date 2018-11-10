<?php
namespace App\Factory;

abstract class Enum
{
    protected $values = array();
    protected $value;


    public function setValue(string $value){
        if (!in_array($value, $this->values)) {
            throw new \InvalidArgumentException("Invalid '".$this->value."' value.");
        }
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

    public function getAll()
    {
        return $this->values;
    }

}