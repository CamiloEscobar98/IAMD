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
        Schema::create('intangible_asset_protection_actions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('intangible_asset_id');

            $table->string('reference')->nullable(); // Existe un depósito ante la autoridad competente para el derecho de autor

            $table->timestamps();

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
        Schema::dropIfExists('intangible_asset_protection_actions');
    }
};
