<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $fillable = [
        'name', 'type', 'quantity', 'unit',
        'min_stock', 'price_per_unit', 'supplier_id', 'notes'
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(StockHistory::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    // Cek stok hampir habis
    public function getIsLowAttribute(): bool
    {
        return $this->quantity <= $this->min_stock;
    }
}
