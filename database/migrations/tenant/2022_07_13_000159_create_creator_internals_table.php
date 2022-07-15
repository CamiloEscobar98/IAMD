<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('creator_internals', function (Blueprint $table) {
            $table->uuid('creator_id')->primary();
            
            $table->unsignedTinyInteger('linkage_type_id')->nullable();
            $table->unsignedSmallInteger('assignment_contract_id')->nullable();

            $table->foreign('creator_id')->references('id')->on('creators')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('linkage_type_id')->references('id')->on('iamd.linkage_types')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('creator_internals');
    }
};
