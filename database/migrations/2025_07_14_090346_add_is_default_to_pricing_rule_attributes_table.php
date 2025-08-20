<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDefaultToPricingRuleAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rule_attributes', function (Blueprint $table) {
            $table->boolean('is_default')->default(false)->after('price_modifier_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricing_rule_attributes', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
}
