<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSra3SheetCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sra3_sheet_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_value_id')->constrained()->onDelete('cascade');
            $table->integer('sheet_count');
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
        Schema::dropIfExists('sra3_sheet_counts');
    }
}
