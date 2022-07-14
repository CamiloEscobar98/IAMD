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
        Schema::create('intangible_asset_type_level3s', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedMediumInteger('intangible_asset_type_level2_id')->nullable();
            $table->string('name');

            $table->foreign('intangible_asset_type_level2_id', 'fk_level2')->references('id')->on('intangible_asset_type_level2s')->cascadeOnUpdate()->nullOnDelete();
            $table->unique(['intangible_asset_type_level2_id', 'name'], 'unique_intangible_asset_type_level3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_type_level3s');
    }
};
