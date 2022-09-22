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
        Schema::create('intangible_asset_publisheds', function (Blueprint $table) {
            $table->unsignedBigInteger('intangible_asset_id')->primary();

            $table->string('published_in'); // Medio de Publicación del Activo Publicado
            $table->tinyText('information_scope')->nullable(); // Alcance de la Publicación
            $table->date('published_at'); // Fecha de la Publicación o Divulgación del Activo

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
        Schema::dropIfExists('intangible_asset_publisheds');
    }
};
