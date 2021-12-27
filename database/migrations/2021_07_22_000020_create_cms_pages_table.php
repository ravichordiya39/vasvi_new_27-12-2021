<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',150);
            $table->string('sub_title',150);
            $table->string('slug',150)->nullable();
            $table->string('url',250)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('meta_title',250)->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('tags')->nullable();
            $table->longText('description',500);

            $table->tinyInteger('status')
            ->default(1)
            ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
