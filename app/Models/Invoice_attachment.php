<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice_attachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoices(): BelongsTo
    {
        return $this->BelongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
