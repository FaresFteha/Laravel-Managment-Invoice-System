<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;
    use SearchableTrait;
    protected $table = 'taxes';
    protected $fillable = ['name', 'value'];

    protected $searchable = [
        'columns' => [
            'taxes.name' => 10,
        ],
    ];
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'tax_id', 'id');
    }
}
