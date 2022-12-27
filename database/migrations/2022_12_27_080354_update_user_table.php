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

            $table->unsignedBigInteger('province_id')->nullable()->after('address');
            $table->foreign('province_id')->references('id')->on('province')->cascadeOnDelete();

            $table->unsignedBigInteger('district_id')->nullable()->after('province_id');
            $table->foreign('district_id')->references('id')->on('district')->cascadeOnDelete();

            $table->unsignedBigInteger('commune_id')->nullable()->after('district_id');
            $table->foreign('commune_id')->references('id')->on('commune')->cascadeOnDelete();
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
