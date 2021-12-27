<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('faq_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyText('question');
            $table->text('answer')->nullable();

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
