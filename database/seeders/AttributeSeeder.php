<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        Attribute::create(['name' => 'Size', 'type' => 'string', 'is_required' => true]);
        Attribute::create(['name' => 'Color', 'type' => 'string', 'is_required' => true]);
        Attribute::create(['name' => 'Expiration', 'type' => 'date', 'is_required' => false]);
    }
}
