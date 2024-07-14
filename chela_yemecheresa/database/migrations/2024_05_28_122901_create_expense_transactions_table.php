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
           // $table->string('type'); // rent,insurance,loan,tax,utilities
            $table->string('reference')->unique()->nullable(); 
            $table->string('attachment')->unique()->nullable();
            $table->string('note')->nullable();
            
            $table->unsignedBigInteger('company_account_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('payment_method_id');
           $table->unsignedBigInteger('currency_manager_id'); 
            $table->unsignedBigInteger('expense_transaction_category_id');

            $table->foreign('company_account_id')->references('id')->on('company_accounts')->onDelete('cascade');
            $table->foreign('expense_transaction_category_id')->references('id')->on('expense_transaction_categories')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');    
           $table->foreign('currency_manager_id')->references('id')->on('currency_managers')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade'); 

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
