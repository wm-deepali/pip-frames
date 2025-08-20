<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomFieldsToAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->string('custom_input_label')->nullable()->after('value');
            $table->boolean('is_composite_value')->default(false)->after('custom_input_label');
            $table->boolean('fixed_extra_charges')->default(false)->after('is_composite_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropColumn(['custom_input_label', 'is_composite_value', 'fixed_extra_charges']);
        });
    }
}
