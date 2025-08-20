<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('parent_attribute_id');
            $table->unsignedBigInteger('parent_value_id');
            $table->unsignedBigInteger('affected_attribute_id');
            $table->unsignedBigInteger('affected_value_id')->nullable();
            $table->enum('action', ['show', 'hide', 'change_options']);
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
        Schema::dropIfExists('attribute_conditions');
    }
}
