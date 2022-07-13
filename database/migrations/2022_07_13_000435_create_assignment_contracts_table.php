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
        Schema::create('assignment_contracts', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string('name');
            $table->boolean('is_internal');

            $table->timestamps();

            $table->unique(['name', 'is_internal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_contracts');
    }
};
