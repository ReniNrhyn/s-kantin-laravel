<?php

namespace App\Models; // namespace: Menunjukkan lokasi model dalam struktur Laravel (app/Models).

use Illuminate\Database\Eloquent\Factories\HasFactory; // HasFactory: Trait untuk membuat factory/fake data (testing/seeding).
use Illuminate\Database\Eloquent\Model; // Model: Class dasar untuk model Eloquent.

class Category extends Model // extends Model: Warisi semua fitur dasar Eloquent ORM.
{
    use HasFactory; // Aktifkan fitur factory untuk pembuatan data dummy.

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
        'description'
    ];
}
