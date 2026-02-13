<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_successful_product_creation(): void
    {
        $clothes = \App\Models\Category::where('name', 'Clothes')->first();
        $size = \App\Models\Attribute::where('name', 'Size')->first();
        $color = \App\Models\Attribute::where('name', 'Color')->first();

        $payload = [
            'name' => 'New Shirt',
            'category_id' => $clothes->id,
            'price' => 25.5,
            'attributes' => [
                $size->id => 'M',
                $color->id => 'Red',
            ],
        ];

        $response = $this->postJson('/products', $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('products', ['name' => 'New Shirt']);
        $this->assertDatabaseHas('product_attribute_values', ['value' => 'M']);
        $this->assertDatabaseHas('product_attribute_values', ['value' => 'Red']);
    }

    public function test_validation_error_missing_name(): void
    {
        $clothes = \App\Models\Category::where('name', 'Clothes')->first();

        $payload = [
            'category_id' => $clothes->id,
            'price' => 10,
        ];

        $response = $this->postJson('/products', $payload);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_cannot_create_when_required_attributes_missing(): void
    {
        $clothes = \App\Models\Category::where('name', 'Clothes')->first();

        $payload = [
            'name' => 'Faulty Shirt',
            'category_id' => $clothes->id,
            'price' => 10,
            // attributes are missing
        ];

        $response = $this->postJson('/products', $payload);
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }
}
