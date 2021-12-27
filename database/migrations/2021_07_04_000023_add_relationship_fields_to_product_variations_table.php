<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductVariationsTable extends Migration
{
    public function up()
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->after('id');
            $table->foreign('product_id', 'product_fk_4312073')->references('id')->on('products');

            $table->unsignedBigInteger('color_id')->after('product_id');
            $table->foreign('color_id', 'color_fk_4312074')->references('id')->on('colors');
        });
    }
}
