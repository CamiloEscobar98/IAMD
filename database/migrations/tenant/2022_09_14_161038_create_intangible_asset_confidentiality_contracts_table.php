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
        Schema::create('intangible_asset_confidentiality_contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('intangible_asset_id');

            $table->string('organization_confidenciality');

            $table->string('file_path')->nullable();
            $table->string('file')->nullable();

            $table->timestamps();

            $table->primary('intangible_asset_id', 'pk_intangible_asset_confidentiality_contracts');
            $table->foreign('intangible_asset_id', 'intangible_asset_fk')->references('id')->on('intangible_assets')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intangible_asset_confidentiality_contracts');
    }
};
