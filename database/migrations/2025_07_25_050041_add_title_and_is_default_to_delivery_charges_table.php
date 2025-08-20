<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndIsDefaultToDeliveryChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_charges', function (Blueprint $table) {
            $table->string('title')->after('no_of_days');
            $table->boolean('is_default')->default(false)->after('price');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_charges', function (Blueprint $table) {
            $table->dropColumn(['title', 'is_default']);
        });
    }
}
