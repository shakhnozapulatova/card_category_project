<?php


namespace App\DataTransferObjects;


final class ProductDto
{
    private $name;

    private $editor_id;

    private $status;

    public function __construct(string $name, string $status = null, int $editor_id = null)
    {
        $this->name = $name;
        $this->status = $status;
        $this->editor_id = $editor_id;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getEditorId()
    {
        return $this->editor_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
