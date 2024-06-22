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
        Schema::create('income_transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
           //$table->string('type'); // earned, passive, retirement,business,investement //can be subtituted by income category
            $table->string('reference')->unique()->nullable();
            $table->string('attachment')->unique()->nullable();
            $table->string('note')->nullable();

            $table->unsignedBigInteger('company_account_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('payment_method_id');
            //$table->unsignedBigInteger('currency_manager_id');  
            $table->unsignedBigInteger('income_transaction_category_id');
           

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');    
           //$table->foreign('currency_manager_id')->references('id')->on('currency_managers')->onDelete('cascade');
            $table->foreign('company_account_id')->references('id')->on('company_accounts')->onDelete('cascade');
            $table->foreign('income_transaction_category_id')->references('id')->on('income_transaction_categories')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_transactions');
    }
};
