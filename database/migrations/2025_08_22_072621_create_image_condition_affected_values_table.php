<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageConditionAffectedValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_condition_affected_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('image_condition_id');
            $table->unsignedBigInteger('value_id');
            $table->string('image')->nullable(); // uploaded image path
            $table->timestamps();

            $table->foreign('image_condition_id')->references('id')->on('image_conditions')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_condition_affected_values');
    }
}
