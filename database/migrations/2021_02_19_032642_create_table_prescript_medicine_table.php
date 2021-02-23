<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePrescriptMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescript_medicine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->nullable();
            $table->integer('prescription_id')->nullable();
            $table->integer('amount_medicine')->nullable();
            $table->integer('total_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescript_medicine');
    }
}
