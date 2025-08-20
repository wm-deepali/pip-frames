<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeDependencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_dependency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id'); // Child attribute
            $table->unsignedBigInteger('parent_attribute_id'); // Parent attribute
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('parent_attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_dependency');
    }
}
