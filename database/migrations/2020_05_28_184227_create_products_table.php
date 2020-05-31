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
            $table->string('brand');
            $table->string('model');
            $table->string('motor');
            $table->string('license');
            $table->string('status');
            $table->float('price',10);
            $table->text('description');
            $table->text('category_id');
            $table->text('user_id');
            $table->string('principal_image_path')->nullable();
            $table->timestamps();
        });
    }
    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
