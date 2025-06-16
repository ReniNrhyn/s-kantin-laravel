<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'stock_id';

    protected $fillable = [
        'stock_id',
        'quantity',
        'operation',
        'operation_date',
        'notes'
    ];

    protected $casts = [
        'operation_date' => 'datetime',
        'quantity' => 'decimal:2'
    ];

    /**
     * Get the ingredient associated with the stock record.
     */
    public function ingredient()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'stock_id');
    }
}
