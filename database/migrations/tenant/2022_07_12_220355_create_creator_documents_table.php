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
        Schema::create('creator_documents', function (Blueprint $table) {
            $table->uuid('creator_id')->primary();


            $table->unsignedSmallInteger('document_type_id');
            $table->string('document',  25)->unique();
            $table->unsignedBigInteger('expedition_place_id');

            $table->foreign('creator_id')->references('id')->on('creators')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('document_type_id')->references('id')->on('iamd.document_types')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('expedition_place_id')->references('id')->on('iamd.cities')->cascadeOnUpdate()->restrictOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_documents');
    }
};
