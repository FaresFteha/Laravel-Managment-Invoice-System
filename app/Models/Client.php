<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use SearchableTrait;
    protected $table = 'clients';

    
    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'postal_code',
        'address',
        'note',
        'country_id',
        'state_id',
        'city_id',
    ];

    protected $searchable = [
        'columns' => [
            'clients.first_name' => 10,
            'clients.last_name' => 10,
            'clients.email' => 10,
        ],
    ];
    
    protected $casts = [
        'website' => 'string',
        'postal_code' => 'string',
        'address' => 'string',
        'note' => 'string',
        'country_id' => 'integer',
        'state_id' => 'integer',
        'city_id' => 'integer',
        'user_id' => 'integer',
    ];
   

    
    protected $appends = ['full_name'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name  . ' ' . $this->last_name;
    }
}
