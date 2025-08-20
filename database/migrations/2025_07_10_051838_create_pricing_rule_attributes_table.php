<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRuleAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_rule_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_rule_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->foreignId('value_id')->constrained('attribute_values')->onDelete('cascade');
            $table->enum('price_modifier_type', ['add', 'multiply']);
            $table->decimal('price_modifier_value', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricing_rule_attributes');
    }
}
