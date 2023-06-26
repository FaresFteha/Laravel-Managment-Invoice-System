<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class category extends Model
{
    use HasFactory;
    use SearchableTrait;
    protected $table = 'categories';

    protected $fillable = ['name'];

    protected $searchable = [
        'columns' => [
            'categories.name' => 10,
        ],
    ];
   public function products() : HasMany
   {
       return $this->hasMany(Product::class , 'category_id' , 'id');
   }
   
}
