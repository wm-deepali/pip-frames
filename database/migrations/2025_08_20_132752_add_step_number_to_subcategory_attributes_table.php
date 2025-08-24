<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepNumberToSubcategoryAttributesTable extends Migration
{
    public function up()
    {
        Schema::table('subcategory_attributes', function (Blueprint $table) {
            $table->integer('step_number')->default(1)->after('sort_order');
        });
    }

    public function down()
    {
        Schema::table('subcategory_attributes', function (Blueprint $table) {
            $table->dropColumn('step_number');
        });
    }
}
