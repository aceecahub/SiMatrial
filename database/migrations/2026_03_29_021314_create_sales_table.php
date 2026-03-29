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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['diambil', 'diantar'])->default('diambil');
            $table->decimal('shipping_cost', 15, 2)->default(0); // Input ongkir jika COD/antar
            $table->decimal('total_price', 15, 2); // Total (barang + ongkir)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
