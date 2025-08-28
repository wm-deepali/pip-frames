<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinDimensionsToPricingRuleAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rule_attributes', function (Blueprint $table) {
            $table->decimal('min_width',8, 2)->nullable()->after('max_width');
            $table->decimal( 'min_height',8, 2)->nullable()->after('max_height');
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
            $table->dropColumn(['min_width', 'min_height']);
        });
    }
}


