<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fromUser_id')->nullable();
            $table->unsignedBigInteger('toUser_id')->nullable();
            $table->unsignedBigInteger('cases')->nullable();
            $table->unsignedBigInteger('treasury')->nullable(); // Corrected column name to 'treasury'
            $table->decimal('amount', 10, 2);
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('description')->nullable();
            $table->string('transaction_type')->nullable();
            $table->enum('status', ['completed', 'pending', 'prepending'])->default('pending');
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('fromUser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('toUser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cases')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('treasury')->references('id')->on('treasuries')->onDelete('cascade'); // Corrected table name to 'treasuries'
   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
