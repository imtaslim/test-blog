<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->unsignedBigInteger("post_id");
            $table->unsignedBigInteger("category_id");
            $table->timestamps();

            $table->unique(["post_id", "category_id"]);

            $table->foreign('post_id')
            ->references('id')
            ->on('posts')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onUpdate('restrict')
            ->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_post');
    }
}