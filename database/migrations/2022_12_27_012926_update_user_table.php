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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->varchar(255)->after('avatar');

            $table->bigInteger('province_id')->unsigned()->after('address');
            $table->foreign('province_id')->references('id')->on('province')->onDelete('cascade');

            $table->bigInteger('district_id')->after('province_id');
            $table->bigInteger('commune_id')->after('district_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
