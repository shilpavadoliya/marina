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
            $table->dropForeign(['brand_id']);
        });
         
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('brand_id');
            $table->dropColumn('product_cost');
            $table->dropColumn('sale_unit');
            $table->dropColumn('purchase_unit');
            $table->dropColumn('stock_alert');
            $table->dropColumn('quantity_limit');
            $table->dropColumn('order_tax');
            $table->dropColumn('tax_type');
            $table->dropColumn('notes');
            $table->dropColumn('barcode_symbol');
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
