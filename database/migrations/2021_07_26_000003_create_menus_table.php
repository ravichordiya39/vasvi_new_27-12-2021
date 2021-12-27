<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('name',100);
            $table->string('slug',100);

            $table->tinyInteger('type')
            ->default(0)
            ->comment('1 - Header / 2 - Footer; Default - 0');

            $table->tinyInteger('status')
            ->default(1)
            ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
