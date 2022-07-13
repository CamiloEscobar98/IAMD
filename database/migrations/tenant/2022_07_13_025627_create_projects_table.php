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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedMediumInteger('research_unit_id');
            $table->uuid('director_id')->nullable();

            $table->string('name')->unique();
            $table->tinyText('description');

            $table->timestamps();

            $table->foreign('research_unit_id')->references('id')->on('research_units')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('director_id')->references('id')->on('creators')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
