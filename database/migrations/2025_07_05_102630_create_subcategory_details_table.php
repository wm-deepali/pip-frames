<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategory_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subcategory_id')->constrained()->onDelete('cascade');

            $table->longText('information')->nullable();
            $table->longText('available_sizes')->nullable();
            $table->longText('binding_options')->nullable();
            $table->longText('paper_types')->nullable();

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
        Schema::dropIfExists('subcategory_details');
    }
}
