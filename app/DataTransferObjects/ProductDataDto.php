<?php


namespace App\DataTransferObjects;


class ProductDataDto
{
    private $name;

    private $value;

    public function __construct(string $name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed|null
     */
    public function getValue()
    {
        return $this->value;
    }
}
