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
        Schema::create('external_organizations', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->string('nit',  20)->unique();
            $table->string('name',  150)->unique();
            $table->string('email')->unique();
            $table->string('telephone',  25)->nullable();
            $table->tinyText('address')->nullable();

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
        Schema::dropIfExists('external_organizations');
    }
};
