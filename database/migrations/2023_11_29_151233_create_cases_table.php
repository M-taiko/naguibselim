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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //الإسم
            $table->string('address')->nullable(); // العنوان بالتفصيل
            $table->integer('age')->nullable(); //السن 
            $table->integer('phone')->nullable(); // رقم الهاتف
            $table->string('maritalStatus')->nullable(); //الحالة الإجتماعية
            $table->string('researcher')->nullable();//باحث الحالة
            $table->string('BelongesTo')->nullable(); //الحالة تابعة لأي جهه//
            $table->string('Neighborhood')->nullable();//الحي
            $table->string('governorate')->nullable();//المحافظه
            $table->string('DescriptionOfTheHouse')->nullable(); //وصف المسكن\
            $table->string('DescriptionOfTheCase')->nullable(); //وصف الحالة\
            $table->integer('income')->nullable();
            $table->integer('NSamount')->nullable();
            $table->date('SearchHistory')->nullable();
            $table->date('receivedDate')->nullable();
            $table->date('HelpHistory')->nullable();
            $table->string('situation')->nullable();//الحالة
            $table->string('IsUrgent')->nullable();//عاجله
            $table->string('notes')->nullable();//ملاحظات
            
            $table->string('StatusType')->nullable(); //نوع الحالة


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
        Schema::dropIfExists('outlets');
    }
};
