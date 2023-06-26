<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'invoices.invoice_number' => 10,
            'clients.first_name' => 10,
            'clients.last_name' => 10,
            'clients.email' => 10,
        ],
        'joins' => [
            'clients' => ['clients.id', 'invoices.client_id'],
        ]
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function invocieattachments(): HasMany
    {
        return $this->hasMany(Invoice_attachment::class, 'invoice_id', 'id');
    }

    public function taxs(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }



    public function invoiceStatus(): HasMany
    {
        return $this->hasMany(Invoice_statu::class, 'invoice_id', 'id');
    }


    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'id');
    }
}
