<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $clothes = Category::where('name', 'Clothes')->first();
        $size = Attribute::where('name', 'Size')->first();
        $color = Attribute::where('name', 'Color')->first();

        if ($clothes && $size && $color) {
            $product = Product::create([
                'category_id' => $clothes->id,
                'name' => 'T-Shirt',
                'description' => 'Comfortable cotton t-shirt',
                'price' => 19.99,
            ]);

            $product->attributeValues()->create(['attribute_id' => $size->id, 'value' => 'L']);
            $product->attributeValues()->create(['attribute_id' => $color->id, 'value' => 'Blue']);
        }
    }
}
