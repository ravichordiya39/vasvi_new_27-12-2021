<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',200);
            $table->string('sub_title',200);
            $table->string('slug',100);
            $table->string('image', 100);
            $table->longText('description',500);
            $table->string('meta_title',250)->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('tags')->nullable();
            $table->datetime('published_on');

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
