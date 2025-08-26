<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToQuoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_items', function (Blueprint $table) {
            $table->string('pet_name')->nullable()->after('quantity');
            $table->date('pet_birthdate')->nullable()->after('pet_name');
            $table->text('personal_text')->nullable()->after('pet_birthdate');
            $table->text('note')->nullable()->after('personal_text');
            $table->json('photos')->nullable()->after('note');
            $table->json('extra_options')->nullable()->after('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_items', function (Blueprint $table) {
            $table->dropColumn([
                'pet_name',
                'pet_birthdate',
                'personal_text',
                'note',
                'photos',
                'extra_options',
            ]);
        });
    }
}
