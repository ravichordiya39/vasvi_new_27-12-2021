<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAttributeValuesTable extends Migration
{
    public function up()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id')->after('id');
            $table->foreign('attribute_id', 'attribute_fk_4310837')->references('id')->on('attributes');
        });
    }
}
