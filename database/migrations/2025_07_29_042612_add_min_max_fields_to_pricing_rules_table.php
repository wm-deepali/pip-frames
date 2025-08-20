<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinMaxFieldsToPricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->integer('min_quantity')->nullable()->after('default_quantity');
            $table->integer('max_quantity')->nullable()->after('min_quantity');
            $table->integer('min_pages')->nullable()->after('default_pages');
            $table->integer('max_pages')->nullable()->after('min_pages');
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
             $table->dropColumn(['min_quantity', 'max_quantity','min_pages', 'max_pages']);
        });
    }
}
