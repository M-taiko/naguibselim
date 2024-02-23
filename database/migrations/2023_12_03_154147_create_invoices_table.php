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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_name')->nullable();
            $table->foreign('supplier_name')->references('id')->on('suppliers')->onDelete('cascade');
            $table->string('outlet_name');
            $table->string('profit');
            $table->string('total_Buy_price');
            $table->string('username');
            $table->string('ordertype');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
