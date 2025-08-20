<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlatRatePerPageToPricingRuleAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rule_attributes', function (Blueprint $table) {
            $table->decimal('flat_rate_per_page', 10, 4)->nullable()->after('extra_copy_charge_type');
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
            $table->dropColumn('flat_rate_per_page');
        });
    }
}
