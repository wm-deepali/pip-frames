<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->enum('type', ['billing', 'shipping'])->default('shipping');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->unsignedBigInteger('city')->nullable();
            $table->unsignedBigInteger('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->boolean('is_default')->default(false);
            $table->string('address_tag')->nullable();
            $table->timestamps();

            // Foreign keys for city, state, country if these tables exist
            $table->foreign('city')->references('id')->on('cities')->nullOnDelete();
            $table->foreign('state')->references('id')->on('states')->nullOnDelete();
            $table->foreign('country')->references('id')->on('countries')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
