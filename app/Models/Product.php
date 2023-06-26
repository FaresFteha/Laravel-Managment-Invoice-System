<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $table = 'products';

    protected $fillable = ['name', 'code', 'category_id', 'unit_price', 'description'];

    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.code' => 10,
        ],
    ];

    //Relasionship to category
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'product_id', 'id');
    }
}
