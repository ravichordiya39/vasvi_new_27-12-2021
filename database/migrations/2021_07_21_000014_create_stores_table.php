<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('contact_person_name', 150);
            $table->string('contact_person_number', 20);
            $table->string('contact_person_designation', 100)->nullable();
            $table->longText('address', 500);
            $table->string('store_pin_code', 10);
            $table->string('store_contact', 20);
            $table->time('open_time');
            $table->time('close_time');
            $table->string('pin_codes', 250);

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
