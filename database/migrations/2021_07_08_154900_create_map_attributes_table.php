<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('map_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id');
            $table->tinyInteger('is_size')->default(0);
            $table->json('sizes')->nullable();
            $table->tinyInteger('is_brand')->default(0);
            $table->json('brands')->nullable();
            $table->tinyInteger('is_color')->default(0);
            $table->json('colors')->nullable();
            $table->tinyInteger('is_attribute')->default(0);
            $table->json('attributes')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_attributes');
    }
}
