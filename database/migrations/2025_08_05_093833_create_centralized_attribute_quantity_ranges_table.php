<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentralizedAttributeQuantityRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centralized_attribute_quantity_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centralized_pricing_id');
            $table->foreign('centralized_pricing_id', 'caqr_pricing_fk')
                ->references('id')
                ->on('centralized_attribute_pricings')
                ->onDelete('cascade');

            $table->integer('quantity_from');
            $table->integer('quantity_to');
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('centralized_attribute_quantity_ranges');
    }
}
