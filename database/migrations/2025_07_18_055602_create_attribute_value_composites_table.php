<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeValueCompositesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_value_composites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('composite_id')->constrained('attribute_values')->cascadeOnDelete();
            $table->foreignId('component_id')->constrained('attribute_values')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['composite_id', 'component_id']); // prevent duplicates
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_value_composites');
    }
}
