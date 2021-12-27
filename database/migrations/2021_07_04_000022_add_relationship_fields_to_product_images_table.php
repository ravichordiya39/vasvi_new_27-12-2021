<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductImagesTable extends Migration
{
    public function up()
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->after('id');
            $table->foreign('product_id', 'product_fk_4311851')->references('id')->on('products');
        });
    }
}
