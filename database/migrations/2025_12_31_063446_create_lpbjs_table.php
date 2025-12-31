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
        Schema::create('lpbjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_by')->constrained('users');
            $table->integer('lpbj_number')->unique();
            $table->foreignId('department_id')->constrained('departments');
            $table->date('request_date');
            
            $table->foreignId('store_id')->constrained('stores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpbjs');
    }
};
