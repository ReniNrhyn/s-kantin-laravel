<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama bahan/menu
            $table->string('type')->default('ingredient'); // ingredient/menu
            $table->decimal('quantity', 10, 2); // Jumlah stok
            $table->string('unit'); // Satuan (kg, pcs, liter, etc)
            $table->decimal('min_stock', 10, 2); // Batas minimum stok
            $table->decimal('price_per_unit', 10, 2); // Harga per satuan
            $table->foreignId('supplier_id')->nullable()->constrained(); // Pemasok
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained();
            $table->decimal('quantity_change', 10, 2); // + untuk tambah, - untuk berkurang
            $table->string('type'); // purchase/usage/adjustment
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->constrained(); // Operator
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_histories');
        Schema::dropIfExists('stocks');
    }
};
