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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID kasir
            $table->foreignId('menu_id')->constrained()->onDelete('cascade'); // ID menu
            $table->string('invoice_number')->unique(); // Nomor transaksi unik
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('payment_method')->default('cash'); // cash, e-wallet, etc.
            $table->date('transaction_date'); // Untuk riwayat transaksi harian
            $table->enum('status', ['completed', 'pending', 'canceled'])->default('completed'); // Status transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
