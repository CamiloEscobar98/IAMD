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
        Schema::create('intangible_asset_type_level2s', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->unsignedTinyInteger('intangible_asset_type_level1_id')->nullable();
            $table->string('name');

            $table->foreign('intangible_asset_type_level1_id', 'fk_level1')->references('id')->on('intangible_asset_type_level1s')->cascadeOnUpdate()->nullOnDelete();
            $table->unique(['intangible_asset_type_level1_id', 'name'], 'unique_intangible_asset_type_level2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_type_level2s');
    }
};
