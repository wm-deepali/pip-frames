<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrientationToImageConditionAffectedValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_condition_affected_values', function (Blueprint $table) {
            $table->enum('orientation', ['landscape', 'portrait'])->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_condition_affected_values', function (Blueprint $table) {
            $table->dropColumn('orientation');
        });
    }
}
