<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingBasicToAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->enum('pricing_basis', ['per_page', 'per_product', 'per_extra_copy', 'fixed_per_page'])->nullable()->after('input_type');
            $table->boolean('has_setup_charge')->default(false)->after('pricing_basis');
            $table->boolean('allow_quantity')->default(false)->after('has_setup_charge');
            $table->boolean('is_composite')->default(false)->after('allow_quantity');
            $table->boolean('has_dependency')->default(false)->after('is_composite');

            // ✅ Self-referencing foreign key
            $table->unsignedBigInteger('dependency_parent')->nullable()->after('has_dependency');
            $table->foreign('dependency_parent')
                ->references('id')
                ->on('attributes')
                ->nullOnDelete(); // Automatically sets dependency_parent to null if the parent row is deleted

            $table->enum('custom_input_type', ['number', 'text', 'file', 'none'])->nullable()->after('dependency_parent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropForeign(['dependency_parent']); // Drop FK before column

            $table->dropColumn([
                'pricing_basis',
                'has_setup_charge',
                'allow_quantity',
                'is_composite',
                'has_dependency',
                'dependency_parent',
                'custom_input_type',
            ]);
        });
    }
}
