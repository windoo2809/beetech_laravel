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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->varchar(255)->unique();
            $table->string('email')->varchar(255)->unique() ;
            $table->string('birthday')->date;
            $table->string('first_name')->varchar(255);
            $table->string('last_name')->varchar(255);
            $table->string('password')->varchar(255);
            $table->string('reset_password')->varchar(255);
            $table->string('status')->varchar(255);
            $table->tinyInteger('flag_delete')->tinyint(1)->default(0);
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
        Schema::dropIfExists('admin');
    }
};
