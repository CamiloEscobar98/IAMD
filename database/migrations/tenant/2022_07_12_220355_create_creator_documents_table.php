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
            $table->unsignedBigInteger('creator_id')->primary();


            $table->unsignedTinyInteger('document_type_id');
            $table->string('document',  25)->unique('unique_document_creator_documents');

            // $table->string('expedition_department',  50)->default('Norte de Santander');
            // $table->string('expedition_place',  50)->default('Cúcuta');

            $table->timestamps();
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
