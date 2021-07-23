<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trashes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            // category
            $table->integer('id_category')->nullable();
            $table->string('name_category')->nullable();
            $table->text('description_category')->nullable();
            $table->string('category_father')->nullable();
            // product
            $table->integer('id_product');
            $table->integer('id_category_product')->nullable();
            $table->string('name_product')->nullable();
            $table->text('description_product')->nullable();
            $table->string('price_product')->nullable();
            $table->integer('stock_product')->nullable();
            $table->integer('archive_id_product')->nullable();
            // archive
            $table->integer('id_archive')->nullable();;
            $table->string('name_archive')->nullable();;
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
        Schema::dropIfExists('trashes');
    }
}
