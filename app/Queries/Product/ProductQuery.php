<?php


namespace App\Queries\Product;

interface ProductQuery
{
    public function byEditorId(int $editorId);

    public function byId(int $productId);

    public function execute();
}
