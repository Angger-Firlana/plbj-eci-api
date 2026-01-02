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
        Schema::create('lpbj_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lpbj_id')->constrained('lpbjs');
            $table->string('media');
            $table->strin('name');
            $table->integer('quantity');
            $table->article('string');
            $table->foreignId('store_id')->constrained('stores');
            $table->string('general_ledger');
            $table->string('cost_center');
            $table->string('order');
            $table->string('information');
            $table->string('item_photo')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpbj_items');
    }
};
