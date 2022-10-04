<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeinToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributegroup_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mtcategory_id');
            $table->unsignedBigInteger('attributegroup_id');

            $table->foreign('mtcategory_id')->references('id')->on('mtcategories')->onDelete('cascade');
            $table->foreign('attributegroup_id')->references('id')->on('attributesgroup')->onDelete('cascade');
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
        Schema::dropIfExists('attributegroup_category');
    }
}
