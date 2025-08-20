<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultQuantityAndPagesToPricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->integer('default_quantity')->nullable();
            $table->integer('default_pages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->dropColumn(['default_quantity', 'default_pages']);
        });
    }
}
