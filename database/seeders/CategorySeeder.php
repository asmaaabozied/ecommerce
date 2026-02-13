<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $food = Category::create(['name' => 'Food']);
        $vegetables = Category::create(['name' => 'Vegetables', 'parent_id' => $food->id]);
        Category::create(['name' => 'Leaf', 'parent_id' => $vegetables->id]);

        $clothes = Category::create(['name' => 'Clothes']);

        // attach attributes if present
        $size = Attribute::where('name', 'Size')->first();
        $color = Attribute::where('name', 'Color')->first();

        if ($size) $clothes->attributes()->attach($size->id);
        if ($color) $clothes->attributes()->attach($color->id);
    }
}
