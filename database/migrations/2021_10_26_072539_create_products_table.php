<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('brand_name')->nullable();
            $table->string('sku_number');
            $table->string('supplier_name')->nullable();
            $table->string('product_weight')->nullable();
            $table->text('description');
            $table->binary('main_image', 255)->comment("The main image uploded path will store")->nullable();
            $table->binary('thumb_image', 255)->comment("The thumbnail image path will store")->nullable();
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
        Schema::dropIfExists('products');
    }
}
