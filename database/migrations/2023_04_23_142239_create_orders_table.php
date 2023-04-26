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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('base_currency_amount', 12, 6);
            $table->string('currency_label')->index();
            $table->unsignedDecimal('currency_amount');
            $table->unsignedDecimal('exchange_rate', 12, 6);
            $table->unsignedDecimal('surcharge_percentage');
            $table->unsignedDecimal('surcharge_amount', 12, 6);
            $table->unsignedDecimal('discount_percentage')->nullable();
            $table->unsignedDecimal('discount_amount', 12, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
