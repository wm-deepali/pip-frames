<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPagesDraggerFieldsToPricingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->boolean('pages_dragger_required')->default(false)->after('subcategory_id');
            $table->unsignedBigInteger('pages_dragger_dependency')->nullable()->after('pages_dragger_required');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricing_rules', function (Blueprint $table) {
            $table->dropColumn(['pages_dragger_required', 'pages_dragger_dependency']);
        });
    }
}
