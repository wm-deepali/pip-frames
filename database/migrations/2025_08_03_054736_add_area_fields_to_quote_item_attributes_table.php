<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaFieldsToQuoteItemAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_item_attributes', function (Blueprint $table) {
            $table->decimal('length', 10, 2)->nullable()->after('value_id');
            $table->decimal('width', 10, 2)->nullable()->after('length');
            $table->string('unit')->nullable()->after('width');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_item_attributes', function (Blueprint $table) {
              $table->dropColumn(['length', 'width', 'unit']);
        });
    }
}
