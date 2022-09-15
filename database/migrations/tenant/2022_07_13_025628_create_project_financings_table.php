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
        Schema::create('project_financings', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->primary();

            $table->unsignedTinyInteger('financing_type_id');
            $table->unsignedTinyInteger('project_contract_type_id');

            $table->string('contract');
            $table->date('date');
            
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('financing_type_id')->references('id')->on('financing_types')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('project_financings');
    }
};
