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
        Schema::create('intangible_asset_comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('intangible_asset_id');

            $table->unsignedBigInteger('user_id');
            $table->mediumText('message');

            $table->timestamps();

            $table->foreign('intangible_asset_id')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_comments');
    }
};
