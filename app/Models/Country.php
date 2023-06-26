<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    public $table = 'countries';

    public $fillable = [
        'name',
        'short_code',
        'phone_code',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'short_code' => 'string',
        'phone_code' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:170|unique:countries,name',
        'short_code' => 'nullable|string|max:170|unique:countries,short_code',
        'phone_code' => 'nullable|integer',
    ];

    /**
     * @return HasMany
     **/
    public function states(): HasMany
    {
        return $this->hasMany(State::class, 'country_id');
    }


}
