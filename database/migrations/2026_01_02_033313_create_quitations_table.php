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
        Schema::create('quitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lpbj_id')->constrained('lpbjs');
            $table->string('quotation_number');
            $table->date('quotation_date');
            $table->string('pr_no');
            $table->string('description');
            $table->string('frenco');
            $table->string('pkp');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quitations');
    }
};
