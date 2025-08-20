<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCentralizedRatesToPricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->boolean('centralized_paper_rates')->default(0)->after('pages_dragger_dependency');
            $table->boolean('centralized_weight_rates')->default(0)->after('centralized_paper_rates');
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
            $table->dropColumn(['centralized_paper_rates', 'centralized_weight_rates']);
        });
    }
}
