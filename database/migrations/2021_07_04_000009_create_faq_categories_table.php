<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyText('description')->nullable();

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
