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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('email')->varchar(100)->unique()->nullable();
            $table->string('phone')->varchar(11)->unique();
            $table->date('birthday');
            $table->string('full_name')->varchar(100);
            $table->string('password');
            $table->string('reset_password');
            $table->string('address')->varchar(255);
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')->references('id')->on('province')->cascadeOnDelete();
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('district')->cascadeOnDelete();
            $table->unsignedBigInteger('commune_id');
            $table->foreign('commune_id')->references('id')->on('commune')->cascadeOnDelete();
            $table->string('status');
            $table->boolean('flag_delete')->default(0);
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
        Schema::dropIfExists('customer');
    }
};
