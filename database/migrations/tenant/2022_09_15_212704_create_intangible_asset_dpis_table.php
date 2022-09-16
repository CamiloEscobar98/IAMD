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
        Schema::create('intangible_asset_dpis', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('intangible_asset_id');
            $table->unsignedMediumInteger('dpi_id');

            $table->foreign('intangible_asset_id')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('dpi_id')->references('id')->on('iamd.intangible_asset_type_level2s')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_dpis');
    }
};
