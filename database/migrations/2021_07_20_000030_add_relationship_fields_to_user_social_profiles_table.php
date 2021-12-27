<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserSocialProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('user_social_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id', 'user_fk_4414593')->references('id')->on('users');

            $table->unsignedBigInteger('social_profile_type_id')->after('user_id');
            $table->foreign('social_profile_type_id', 'social_profile_type_fk_4414594')
                ->references('id')
                ->on('social_profile_types');
        });
    }
}
