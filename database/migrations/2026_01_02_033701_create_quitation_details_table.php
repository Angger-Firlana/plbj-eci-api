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
        Schema::create('quitation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quitation_id')->constrained('quitations');
            $table->foreigId('item_id')->constrained('lpbj_items');
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quitation_details');
    }
};
