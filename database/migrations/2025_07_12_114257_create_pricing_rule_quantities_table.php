<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRuleQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_rule_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_rule_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_from');
            $table->integer('quantity_to');
            $table->decimal('base_price', 10, 2);
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
        Schema::dropIfExists('pricing_rule_quantities');
    }
}
