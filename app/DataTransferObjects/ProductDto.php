<?php


namespace App\DataTransferObjects;


class ProductDto
{
    public $name;

    public $editor_id;

    public $status;

    public function __construct(string $name, int $editor_id, string $status)
    {
        $this->name = $name;
        $this->editor_id = $editor_id;
        $this->status = $status;
    }
}
