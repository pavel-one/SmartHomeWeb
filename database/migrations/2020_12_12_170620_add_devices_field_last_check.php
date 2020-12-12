<?php

use App\Models\UserDevice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevicesFieldLastCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(UserDevice::TABLE, function (Blueprint $table) {
            $table->dateTime('last_check')->default('2020-12-01 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(UserDevice::TABLE, function (Blueprint $table) {
            $table->dropColumn('last_check');
        });
    }
}
