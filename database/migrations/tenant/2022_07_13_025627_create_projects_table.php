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

            $table->uuid('director_id')->nullable();
            $table->unsignedTinyInteger('project_contract_type_id');

            $table->string('name')->unique();
            $table->tinyText('description')->nullable();
            $table->string('contract');
            $table->date('date');

            $table->timestamps();

            $table->foreign('director_id')->references('id')->on('creators')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('project_contract_type_id')->references('id')->on('project_contract_types')->cascadeOnUpdate()->restrictOnDelete();
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
