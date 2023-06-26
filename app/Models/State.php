<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    use HasFactory;
    public $table = 'states';

    public $fillable = [
        'name',
        'country_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'country_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:170|unique:states,name',
        'country_id' => 'required',
    ];

    protected $appends = ['country_name'];

    /**
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->country->name ?? 'N/A';
    }

    /**
     * @return BelongsTo
     **/
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return belongsTo
     **/
    public function city(): belongsTo
    {
        return $this->belongsTo(City::class, 'state_id');
    }
}
