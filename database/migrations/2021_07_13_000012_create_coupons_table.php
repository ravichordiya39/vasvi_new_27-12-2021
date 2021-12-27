<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->tinyInteger('coupon_type')
                ->default(0)
                ->comment('0 - Private / 1 - Bulk Order / 2 - Retail Order; Default - 0');

            $table->tinyInteger('user_type')
                ->default(0)
                ->comment('0 - All Users / 1 - Existing Users / 2 - New Users; Default - 0');

            $table->tinyInteger('discount_type')
                ->default(0)
                ->comment('0 - Percentage / 1 - Flat; Default - 0');

            $table->float('value', 10, 2);
            $table->datetime('valid_from')->nullable();
            $table->datetime('valid_to')->nullable();
            $table->string('coupon_name', 100);
            $table->float('min_cart_amt', 10, 2)->nullable();
            $table->string('code', 20);
            $table->string('image')->nullable();
            $table->float('max_discount', 10, 2)->nullable();
            $table->boolean('is_unlimited')->default(0)->nullable();
            $table->integer('avlb_coupons')->default(0);

            $table->tinyInteger('status')->default(1)
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->longText('term_conditions')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
