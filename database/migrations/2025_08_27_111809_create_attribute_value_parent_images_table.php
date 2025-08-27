<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeValueParentImagesTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_value_parent_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_value_id');
            $table->unsignedBigInteger('parent_attribute_id');
            $table->unsignedBigInteger('parent_attribute_value_id');
            $table->string('image_path');
            $table->enum('orientation', ['portrait', 'landscape'])->default('portrait');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
            $table->foreign('parent_attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('parent_attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');

            $table->unique(['attribute_value_id', 'parent_attribute_id', 'parent_attribute_value_id'], 'avpi_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_value_parent_images');
    }
}
