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
        Schema::create('product', function (Blueprint $table) {
                $table->id();
                $table->string('sku')->varchar(255)->unique();
                $table->string('user_name')->varchar(255)->unique();
                $table->string('stock')->int();
                $table->string('avatar')->varchar(255);
                $table->date('expired_at');
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('product_category');
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
        Schema::dropIfExists('product');
    }
};
