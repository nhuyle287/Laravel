<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTableTypestaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('typestaffs')) {
            Schema::table('typestaffs', function (Blueprint $table) {
                if (!Schema::hasColumn('typestaffs', 'deleted_at')) {
                    $table->softDeletes()->nullable()->after('updated_at');
                }

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('typestaffs')) {
            Schema::table('typestaffs', function (Blueprint $table) {
                if (!Schema::hasColumn('typestaffs', 'deleted_at')) {
                    $table->dropColumn('deleted_at');
                }

            });
        }
    }
}
