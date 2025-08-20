<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRuleAttributeDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_rule_attribute_dependencies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pricing_rule_attribute_id');
            $table->unsignedBigInteger('parent_attribute_id');
            $table->unsignedBigInteger('parent_value_id');

            // Foreign Keys with shorter names
            $table->foreign('pricing_rule_attribute_id', 'prad_pricing_attr_id_fk')
                ->references('id')
                ->on('pricing_rule_attributes')
                ->onDelete('cascade');

            $table->foreign('parent_attribute_id', 'prad_parent_attr_id_fk')
                ->references('id')
                ->on('attributes')
                ->onDelete('cascade');

            $table->foreign('parent_value_id', 'prad_parent_value_id_fk')
                ->references('id')
                ->on('attribute_values')
                ->onDelete('cascade');

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
        Schema::dropIfExists('pricing_rule_attribute_dependencies');
    }
}
