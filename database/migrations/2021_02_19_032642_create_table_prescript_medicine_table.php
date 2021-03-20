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
            $table->float('amount_date')->nullable();
            $table->float('morning')->nullable();
            $table->float('afternoon')->nullable();
            $table->float('everning')->nullable();
            $table->float('night')->nullable();
            $table->float('amount_medicine')->nullable();
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
        Schema::dropIfExists('prescript_medicine');
    }
}
