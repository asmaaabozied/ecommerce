<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Validation\ValidationException;

class ProductService
{
    protected $categoryRepo;
    protected $productRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo, ProductRepositoryInterface $productRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->productRepo = $productRepo;
    }

    public function create(array $data)
    {
        $category = $this->categoryRepo->find($data['category_id']);

        if (! $category) {
            throw ValidationException::withMessages(['category_id' => 'Invalid category']);
        }

        // Enforce required attributes
        $required = $category->attributes->where('is_required', true)->pluck('id')->toArray();

        $provided = [];
        if (! empty($data['attributes']) && is_array($data['attributes'])) {
            foreach ($data['attributes'] as $attrId => $value) {
                $provided[] = (int) $attrId;
            }
        }

        $missing = array_diff($required, $provided);

        if (! empty($missing)) {
            $missingNames = $category->attributes->whereIn('id', $missing)->pluck('name')->toArray();
            throw ValidationException::withMessages(['attributes' => 'Missing required attributes: ' . implode(', ', $missingNames)]);
        }

        $productData = [
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'] ?? 0,
        ];

        $product = $this->productRepo->create($productData);

        if (! empty($data['attributes']) && is_array($data['attributes'])) {
            foreach ($data['attributes'] as $attrId => $value) {
                $this->productRepo->addAttributeValue($product->id, (int) $attrId, $value);
            }
        }

        return $product->load('attributeValues');
    }
}
