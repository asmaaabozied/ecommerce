<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductAttributeValue;

class ProductRepository
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function addAttributeValue(int $productId, int $attributeId, $value)
    {
        return ProductAttributeValue::create([
            'product_id' => $productId,
            'attribute_id' => $attributeId,
            'value' => is_array($value) ? json_encode($value) : (string) $value,
        ]);
    }
}
