<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaxDimensionsToPricingRuleAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('pricing_rule_attributes', function (Blueprint $table) {
            $table->decimal('max_width', 8, 2)->nullable()->after('value_id');
            $table->decimal('max_height', 8, 2)->nullable()->after('max_width');
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
            $table->dropColumn('max_width');
            $table->dropColumn('max_height');
        });
    }
}
