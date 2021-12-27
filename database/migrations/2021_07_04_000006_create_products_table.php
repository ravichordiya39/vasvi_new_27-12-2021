<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku_code')->unique();
            $table->string('hsn_code')->nullable();
            $table->decimal('mrp_price', 15, 2);
            $table->float('tax_rate', 10, 2)->nullable();
            $table->string('discount_type')->nullable();
            $table->float('discount', 10, 2)->nullable();
            $table->decimal('sales_price', 15, 2)->nullable();
            $table->boolean('in_stock')->default(0);
            $table->boolean('is_bulk')->default(0);
            $table->boolean('is_exclusive')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_new')->default(0);
            $table->boolean('has_varient')->default(0);
            $table->longText('description');
            $table->integer('view_count')->default(0);

            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 - Active / 0 - Inactive; Default - 1');

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
