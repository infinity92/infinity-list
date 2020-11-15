<?php


namespace App\Enums;


abstract class Enum
{
    const __default = null;

    private $value;

    public function __construct($value = null)
    {
        $acceptValues = array_values($this->getConstants());
        if (!in_array($value, $acceptValues)) {
            throw new \Exception('Incorrect enum value');
        }

        $this->value = $value;
    }

    public function getConstants() {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public function getValue()
    {
        return $this->value ?? static::__default;
    }
}
