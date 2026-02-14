<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'is_required'];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_attribute');
    }
}
