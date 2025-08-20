<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteMetaContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_meta_contents', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->string('canonical_link')->nullable();
            $table->string('og_locale')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_image')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_site_name')->nullable();
            $table->string('twitter_card')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('twitter_site')->nullable();
            $table->string('twitter_creator')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('publisher')->nullable();
            $table->text('og_tag')->nullable();
            $table->string('twitter_tag_url')->nullable();
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
        Schema::dropIfExists('site_meta_contents');
    }
}
