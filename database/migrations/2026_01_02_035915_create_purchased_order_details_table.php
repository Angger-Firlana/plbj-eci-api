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
        Schema::create('purchased_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchased_order_id')->constrained('purchased_orders')->onDelete('cascade');
            $table->foreignId('quotation_detail_id')->constrained('quotation_details')->onDelete('cascade');
            $table->string('item_name');
            $table->string('model');
            $table->integer('quantity');
            $table->decimal('discount', 5, 2)->default(0.00);
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_order_details');
    }
};
