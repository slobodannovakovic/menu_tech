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
            $table->unsignedInteger('base_currency_amount');
            $table->string('currency_label')->index();
            $table->unsignedDecimal('currency_amount');
            $table->unsignedDecimal('exchange rate', 12, 6);
            $table->unsignedDecimal('surcharge_percentage');
            $table->unsignedDecimal('surcharge_amount');
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
