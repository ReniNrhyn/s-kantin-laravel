<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'menu_id',
        'invoice_number',
        'quantity',
        'total_price',
        'payment_method',
        'transaction_date',
        'status',
    ];

    /**
     * Define the relationship with the User (Kasir).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the Menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
