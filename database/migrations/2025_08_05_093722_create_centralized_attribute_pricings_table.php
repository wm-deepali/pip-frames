<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentralizedAttributePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centralized_attribute_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained(table: 'attributes')->onDelete('cascade');
            $table->unsignedBigInteger('value_id')->nullable();
            $table->foreign('value_id')
                ->references('id')
                ->on('attribute_values')
                ->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();
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
        Schema::dropIfExists('centralized_attribute_pricings');
    }
}
