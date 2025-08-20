<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProofReadingAndDeliveryChargesToPricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->boolean('proof_reading_required')->default(0);
            $table->boolean('delivery_charges_required')->default(0);
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
            $table->dropColumn(['proof_reading_required', 'delivery_charges_required']);
        });
    }
}
