<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_category_id')->after('product_category_id');
            $table->foreign('sub_category_id')->references('id')
                ->on('product_sub_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->longText('product_description')->after('name');
            $table->string('minimum_price')->nullable()->after('product_price');
            $table->enum('product_type', ['1', '2'])->nullable()->comment('1 - b2b, 2 - b2c')->after('product_price');
            $table->enum('mutton_type', ['1', '2'])->nullable()->comment('1 - goat, 2 - lamb')->after('product_price');
            $table->enum('suitable_type', ['1', '2'])->nullable()->comment('1 - boneless, 2 - bonein')->after('product_price');
            $table->enum('package_size', ['1', '2'])->nullable()->comment('1 - regular, 2 - large')->after('product_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
