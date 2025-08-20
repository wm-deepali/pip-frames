<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('quote_number');
            $table->string('order_number')->nullable()->unique();
            $table->string('status')->default('pending');
            $table->integer('customer_id');
            $table->decimal('vat_amount', 10, 2)->nullable();
            $table->decimal('vat_percentage', 5, 2)->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->string('proof_type')->nullable();        // from $cart['proof']['proof_type']
            $table->decimal('proof_price', 10, 2)->nullable(); // from $cart['proof']['price']
            $table->decimal('delivery_price', 10, 2)->nullable(); // from $cart['delivery']['price']
            $table->date('delivery_date')->nullable();       // optional parsed from string
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
        Schema::dropIfExists('quotes');
    }
}
