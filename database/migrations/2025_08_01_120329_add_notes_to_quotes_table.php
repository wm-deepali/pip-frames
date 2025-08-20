<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToQuotesTable extends Migration
{
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('grand_total');
        });
    }

    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
}
