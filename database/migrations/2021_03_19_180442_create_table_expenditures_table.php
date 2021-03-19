<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_staff')->nullable();
            $table->float('price')->nullable();
            $table->string('description')->nullable();
            $table->string('receiver')->nullable();
            $table->string('address_receiver')->nullable();
            $table->datetime('date')->nullable();
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
        Schema::dropIfExists('expenditures');
    }
}
