<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;
    public $table = 'cities';

    public $fillable = [
        'name',
        'state_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'state_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:170',
        'state_id' => 'required',
    ];

    protected $appends = ['state_name'];

    /**
     * @return string
     */
    public function getStateNameAttribute(): string
    {
        return $this->state->name ?? 'N/A';
    }

    /**
     * @return BelongsTo
     **/
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
