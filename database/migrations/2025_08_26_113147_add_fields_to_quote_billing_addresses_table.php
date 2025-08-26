<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToQuoteBillingAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('quote_billing_addresses', function (Blueprint $table) {
            $table->string('city')->nullable()->after('address');
            $table->string('postcode')->nullable()->after('city');
        });
    }

    public function down()
    {
        Schema::table('quote_billing_addresses', function (Blueprint $table) {
            $table->dropColumn(['city', 'postcode']);
        });
    }
}
