<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('contact_number')->nullable();
            $table->boolean('show_on_header')->default(false);
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->text('full_address')->nullable();
            $table->text('location_map')->nullable();
            $table->string('website_url')->nullable();
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
        Schema::dropIfExists('contact_infos');
    }
}
