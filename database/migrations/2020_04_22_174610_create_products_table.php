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
            $table->string('slug');
            $table->string('name');
            $table->string('cover_image')->nullable();
            $table->integer('quantity');
            $table->boolean('available');
            $table->enum('currency', config('currencies'));
            $table->longText('description');
            $table->longText('scout_comment');

            /* many-to-many */
            // - sizes
            // - colors
            // - categories
            // - images
            // - merchants
            // - details
            // - materials
            // - reports

            $table->timestamps();
            $table->softDeletes();
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
