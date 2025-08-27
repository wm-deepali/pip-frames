<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowFieldsToContactInfosTable extends Migration
{
    public function up()
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->boolean('show_on_footer')->default(false)->after('show_on_header');
            $table->boolean('show_on_header_mobile')->default(false)->after('mobile_number');
            $table->boolean('show_on_footer_mobile')->default(false)->after('show_on_header_mobile');
            $table->boolean('show_on_header_email')->default(false)->after('email');
            $table->boolean('show_on_footer_email')->default(false)->after('show_on_header_email');
        });
    }

    public function down()
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->dropColumn([
                'show_on_footer',
                'show_on_header_mobile',
                'show_on_footer_mobile',
                'show_on_header_email',
                'show_on_footer_email',
            ]);
        });
    }
}
