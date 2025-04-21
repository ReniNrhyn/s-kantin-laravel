<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'menu_id',
        'invoice_number',
        'quantity',
        'total_price',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Format tanggal transaksi
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y, H:i');
    }

    // Format total harga
    public function getFormattedTotalAttribute()
    {
        return 'Rp '.number_format($this->total_price, 0, ',', '.');
    }
}
