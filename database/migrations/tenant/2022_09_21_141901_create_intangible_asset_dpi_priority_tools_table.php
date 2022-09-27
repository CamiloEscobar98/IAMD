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
        Schema::create('intangible_asset_dpi_priority_tools', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('intangible_asset_id');
            $table->unsignedMediumInteger('dpi_id');
            $table->unsignedSmallInteger('priority_tool_id');

            $table->unique(['intangible_asset_id', 'dpi_id', 'priority_tool_id'], 'unique_intangible_asset_dpi_priority_tools');

            $table->foreign('intangible_asset_id', 'asset_dpi_priority_tools_intangible_asset_fk')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('dpi_id', 'asset_dpi_priority_tools_dpi_id_fk')->references('id')->on('iamd.intellectual_property_right_subcategories')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('priority_tool_id', 'asset_dpi_priority_tools_priority_tool_fk')->references('id')->on('priority_tools')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_dpi_priority_tools');
    }
};
