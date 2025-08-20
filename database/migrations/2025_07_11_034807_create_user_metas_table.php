<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('user_metas', function (Blueprint $table) {
            $table->id(); // id
            $table->unsignedBigInteger('user_id'); // user_id
            $table->text('bio')->nullable(); // bio
            $table->string('address')->nullable(); // address
            $table->unsignedBigInteger('country_id')->nullable(); // country_id
            $table->unsignedBigInteger('state_id')->nullable(); // state_id
            $table->unsignedBigInteger('city_id')->nullable(); // city_id
            $table->string('website')->nullable(); // website
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraint (optional but recommended)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_metas');
    }
}
