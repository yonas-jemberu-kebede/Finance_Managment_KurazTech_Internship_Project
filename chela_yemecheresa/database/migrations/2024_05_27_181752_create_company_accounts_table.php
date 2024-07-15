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
        Schema::create('company_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('account_number')->unique();
            $table->string('account_currency');
            $table->decimal('opening_balance',15,2);
            $table->decimal('amount',15,2);
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_accounts');
    }
};
