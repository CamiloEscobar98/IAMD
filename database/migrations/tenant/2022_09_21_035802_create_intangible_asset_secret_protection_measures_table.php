<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intangible_asset_secret_protection_measure', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('intangible_asset_id');
            $table->unsignedSmallInteger('secret_protection_measure_id');

            $table->foreign('intangible_asset_id', 'secret_protection_measure_intangible_asset_fk')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('secret_protection_measure_id', 'secret_protection_measure_secret_protection_fk')->references('id')->on('secret_protection_measures')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_secret_protection_measure');
    }
};
