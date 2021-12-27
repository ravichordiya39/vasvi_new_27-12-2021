<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('logo');
            $table->text('description')->nullable();

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
