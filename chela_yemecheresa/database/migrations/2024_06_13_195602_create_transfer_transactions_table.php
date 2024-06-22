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
        Schema::create('transfer_transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);

            $table->string('reference')->unique();
            $table->string('attachment')->unique();
            $table->string('note')->nullable();
            
            $table->unsignedBigInteger('payment_method_id');
            //$table->unsignedBigInteger('currency_manager_id'); 
           
            $table->unsignedBigInteger('company_account_id');
            $table->unsignedBigInteger('target_account_id');
           

     
 
            
            $table->foreign('company_account_id')->references('id')->on('company_accounts')->onDelete('cascade');
            $table->foreign('target_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');    
            //$table->foreign('currency_manager_id')->references('id')->on('currency_managers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_transactions');
    }
};
