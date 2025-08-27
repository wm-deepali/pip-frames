<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeImageDependenciesTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_image_dependencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_attribute_id');
            $table->unsignedBigInteger('parent_attribute_id');
            $table->timestamps();

            $table->foreign('child_attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('parent_attribute_id')->references('id')->on('attributes')->onDelete('cascade');

            $table->unique(['child_attribute_id', 'parent_attribute_id'], 'attr_img_dep_unique');
        });

    }

    public function down()
    {
        Schema::dropIfExists('attribute_image_dependencies');
    }
}
