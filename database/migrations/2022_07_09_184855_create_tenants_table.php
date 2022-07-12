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
        Schema::create('tenants', function (Blueprint $table) {
            $table->tinyIncrements('id');

            $table->string('name');

            $table->string('driver', 20)->default('mysql');
            $table->string('url')->nullable();
            $table->string('host', 20)->default('127.1.0.0');
            $table->string('port', 6)->default('3306');

            $table->string('database')->default('forge');
            $table->string('username')->default('forge');
            $table->string('password')->nullable();

            $table->string('unix_socket')->nullable();
            $table->string('charset')->default('utf8mb4');
            $table->string('collation')->default('utf8mb4_unicode_ci');
            $table->string('prefix')->nullable();
            $table->boolean('prefix_indexes')->default(true);
            $table->boolean('strict')->default(true);
            $table->string('engine')->nullable();

            /** For PGSQL */
            $table->string('search_path')->nullable(); // DEFAULT: 'public'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};
