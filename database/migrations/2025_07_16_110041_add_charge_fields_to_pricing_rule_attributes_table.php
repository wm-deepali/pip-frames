<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChargeFieldsToPricingRuleAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rule_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('dependency_value_id')->nullable()->after('value_id');
            $table->foreign('dependency_value_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->string('base_charges_type', 20)->nullable()->after('price_modifier_value');
            $table->decimal('extra_copy_charge', 10, 2)->nullable()->after('base_charges_type');
            $table->string('extra_copy_charge_type', 20)->nullable()->after('extra_copy_charge');
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
            $table->dropColumn([
                'dependency_value_id',
                'base_charges_type',
                'extra_copy_charge',
                'extra_copy_charge_type',
            ]);
        });
    }
}
