<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function create(array $data): Product;

    /**
     * Add or persist an attribute value for a product.
     *
     * @param int $productId
     * @param int $attributeId
     * @param mixed $value
     * @return mixed
     */
    public function addAttributeValue(int $productId, int $attributeId, $value);
}
