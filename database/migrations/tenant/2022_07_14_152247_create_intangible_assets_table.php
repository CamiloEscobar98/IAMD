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
        Schema::create('intangible_assets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedInteger('classification_id')->nullable();
            $table->unsignedSmallInteger('intangible_asset_state_id')->nullable();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('code')->nullable();
            $table->string('path')->nullable();

            $table->timestamps();

            $table->unique(['project_id', 'name', 'code']);

            $table->foreign('classification_id')->references('id')->on('iamd.intellectual_property_right_products')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('intangible_asset_state_id')->references('id')->on('iamd.intangible_asset_states')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_assets');
    }
};
