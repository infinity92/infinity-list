<?php


namespace App\Enums;


use phpDocumentor\Reflection\Types\Static_;

abstract class Enum
{
    const __default = null;

    private $value;

    public function __construct($value = null)
    {
        $acceptValues = array_values(static::getConstants());
        if (!in_array($value, $acceptValues)) {
            throw new \Exception('Incorrect enum value');
        }

        $this->value = $value;
    }

    public static function getConstants() {
        $oClass = new \ReflectionClass(static::class);
        return $oClass->getConstants();
    }

    public function getValue()
    {
        return $this->value ?? static::__default;
    }
}
