<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name',150);
            $table->string('city',150);
            $table->string('image', 100);
            $table->longText('description',500);

            $table->tinyInteger('status')
            ->default(1)
            ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
