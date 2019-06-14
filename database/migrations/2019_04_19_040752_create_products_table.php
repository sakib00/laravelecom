<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('products')){
           Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements('product_row_id');
                $table->string('product_name');
                $table->double('product_price');
                $table->string('product_height')->nullable();
                $table->string('product_width')->nullable();
                $table->string('product_weight')->nullable();
                $table->string('product_sku');
                $table->string('product_image');
                $table->string('product_description')->nullable();
                $table->tinyInteger('product_rating')->default(0);
                $table->tinyInteger('is_latest')->default(0);
                $table->tinyInteger('is_featured')->default(0);
                $table->timestamps();
             });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
