<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMtcategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtcategory_product', function (Blueprint $table) {
            $table->unsignedBigInteger('mtcategory_id');
            $table->foreign('mtcategory_id')->references('id')->on('mtcategories');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtcategory_product');
    }
}
