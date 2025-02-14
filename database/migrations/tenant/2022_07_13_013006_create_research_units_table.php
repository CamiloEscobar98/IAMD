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
        Schema::create('research_units', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->unsignedSmallInteger('administrative_unit_id'); // Unidad Administrativa a la que pertenece
            $table->unsignedTinyInteger('research_unit_category_id'); // Grupo de Investigación, OPS
            $table->unsignedMediumInteger('academic_department_id')->nullable();

            $table->uuid('director_id')->nullable(); // Director de la Unidad de Investigación (Creador)
            $table->uuid('inventory_manager_id')->nullable(); // Responsable de Inventario de la Unidad de Investigación (Creador)

            $table->string('name');
            $table->tinyText('description')->nullable();
            $table->string('code');

            $table->timestamps();

            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('research_unit_category_id')->references('id')->on('research_unit_categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('academic_department_id')->references('id')->on('academic_departments')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('director_id')->references('id')->on('creators')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('inventory_manager_id')->references('id')->on('creators')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_units');
    }
};
