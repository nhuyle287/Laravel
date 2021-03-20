<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMedicalExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_examinations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_examination')->nullable();
            $table->integer('circuit')->nullable();
            $table->float('temperature')->nullable();
            $table->integer('breathing')->nullable();
            $table->integer('blood_pressure')->nullable();
            $table->string('diagnostic')->nullable();
            $table->integer('price_public')->nullable();
            $table->integer('ECG')->nullable();
            $table->integer('blood_sugar')->nullable();
            $table->float('total_price')->nullable();
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
        Schema::dropIfExists('medical_examinations');
    }
}
