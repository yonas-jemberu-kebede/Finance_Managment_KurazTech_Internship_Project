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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_manager_id'); 
            $table->string('name');
            $table->string('account_number')->unique();
            $table->decimal('opening_balance',15,2);
            $table->decimal('current_balance', 10, 2);
            
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('note')->nullable();
            
           
            $table->foreign('currency_manager_id')->references('id')->on('currency_managers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
