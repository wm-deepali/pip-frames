<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->id();
            $table->string('pincode', 10); 
            $table->string('country'); // e.g. "United Kingdom", "Germany", "India"
               $table->string('continent')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->decimal('delivery_charge', 8, 2)->nullable();
            $table->boolean('is_serviceable')->default(true);
            $table->timestamps();

            $table->unique(['pincode', 'country']); // Ensure unique per country
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postal_codes');
    }
}
