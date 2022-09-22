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
        Schema::create('intangible_asset_phases', function (Blueprint $table) {
            $table->unsignedBigInteger('intangible_asset_id')->primary();

            $table->boolean('phase_one_completed')->default(false)->nullable();
            $table->boolean('phase_two_completed')->default(false)->nullable();
            $table->boolean('phase_three_completed')->default(false)->nullable();
            $table->boolean('phase_four_completed')->default(false)->nullable();
            $table->boolean('phase_five_completed')->default(false)->nullable();
            $table->boolean('phase_six_completed')->default(false)->nullable();
            $table->boolean('phase_seven_completed')->default(false)->nullable();
            $table->boolean('phase_eight_completed')->default(false)->nullable();
            $table->boolean('phase_nine_completed')->default(false)->nullable();

            $table->foreign('intangible_asset_id')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_phases');
    }
};
