<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductAttributesTable extends Migration
{
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->after('id');
            $table->foreign('product_id', 'product_fk_4313310')->references('id')->on('products');

            $table->unsignedBigInteger('attribute_id')->after('product_id');
            $table->foreign('attribute_id', 'attribute_fk_4313311')->references('id')->on('attributes');

            $table->unsignedBigInteger('attribute_value_id')->after('attribute_id');
            $table->foreign('attribute_value_id', 'attribute_value_fk_4313312')->references('id')->on('attribute_values');
        });
    }
}
