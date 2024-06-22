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
        Schema::create('currency_managers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('exchange_rate', 15, 4);
            $table->boolean('is_basecurrency')->default(false); // true for yes, false for no
            $table->enum('status',['Active','Inactive'])->default('Active'); // true for active, false for inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_managers');
    }
};
