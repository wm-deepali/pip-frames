<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRuleAttributeQuantitiesTable extends Migration
{
    public function up()
    {
        Schema::create('pricing_rule_attribute_quantities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pricing_rule_attribute_id');
            $table->integer('quantity_from');
            $table->integer('quantity_to');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            // Short constraint name to avoid MySQL 64-character limit
            $table->foreign('pricing_rule_attribute_id', 'praq_pra_id_fk')
                  ->references('id')
                  ->on('pricing_rule_attributes')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pricing_rule_attribute_quantities');
    }
}
