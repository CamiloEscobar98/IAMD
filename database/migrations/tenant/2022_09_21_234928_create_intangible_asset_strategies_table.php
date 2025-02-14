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
        Schema::create('intangible_asset_strategies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('intangible_asset_id');
            $table->unsignedTinyInteger('strategy_category_id');
            $table->unsignedMediumInteger('strategy_id');
            $table->unsignedBigInteger('user_id');

            $table->unique(['intangible_asset_id', 'strategy_category_id', 'strategy_id'], 'intangible_asset_strategies_unique');

            $table->foreign('intangible_asset_id', 'strategies_intangible_asset_fk')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('strategy_id')->references('id')->on('strategies')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('strategy_category_id')->references('id')->on('strategy_categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_strategies');
    }
};
