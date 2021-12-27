<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id', 'user_fk_4311814')->references('id')->on('users');

            $table->unsignedBigInteger('category_id')->after('user_id');
            $table->foreign('category_id', 'category_fk_4311812')->references('id')->on('categories');

            $table->unsignedBigInteger('sub_category_id')->after('category_id');
            $table->foreign('sub_category_id', 'sub_category_fk_4311813')
                ->references('id')
                ->on('categories');

            $table->unsignedBigInteger('brand_id')->after('sub_category_id');
            $table->foreign('brand_id', 'brand_fk_4311819')->references('id')->on('brands');
        });
    }
}
