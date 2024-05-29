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
        Schema::create('expense_transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->string('type'); // rent,insurance,loan,tax,utilities
            $table->string('reference')->unique();
          
            $table->string('attachment')->unique();
            
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('vendor_id');
            
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade'); 
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_transactions');
    }
};
