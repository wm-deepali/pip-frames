<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('extra_options', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., "Digital download"
            $table->string('description')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('code')->nullable(); // e.g., 'digital', 'skip'
            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('extra_options');
    }
}
