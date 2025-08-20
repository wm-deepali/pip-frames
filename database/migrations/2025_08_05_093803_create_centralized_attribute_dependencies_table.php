<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentralizedAttributeDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centralized_attribute_dependencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centralized_pricing_id');
            $table->foreign('centralized_pricing_id', 'dep_pricing_fk')
                ->references('id')
                ->on('centralized_attribute_pricings')
                ->onDelete('cascade');

            $table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade');
            $table->foreignId('value_id')->constrained('attribute_values')->onDelete('cascade');
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
        Schema::dropIfExists('centralized_attribute_dependencies');
    }
}
