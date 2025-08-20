<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeGroupSubcategoryAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_group_subcategory_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_group_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_toggleable')->default(false);
            $table->timestamps();

            // SHORTER CONSTRAINT NAMES
            $table->foreign('attribute_group_id', 'agsa_group_fk')
                ->references('id')->on('attribute_groups')->onDelete('cascade');

            $table->foreign('subcategory_id', 'agsa_subcat_fk')
                ->references('id')->on('subcategories')->onDelete('cascade');

            $table->unique(['attribute_group_id', 'subcategory_id'], 'agsa_unique');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_group_subcategory_assignments');
    }
}
