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
        Schema::create('creator_externals', function (Blueprint $table) {
            $table->uuid('creator_id')->primary();

            $table->unsignedMediumInteger('external_organization_id')->nullable();
            $table->unsignedSmallInteger('assignment_contract_id')->nullable();

            $table->foreign('creator_id')->references('id')->on('creators')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('external_organization_id')->references('id')->on('iamd.external_organizations')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('assignment_contract_id')->references('id')->on('iamd.assignment_contracts')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_externals');
    }
};
