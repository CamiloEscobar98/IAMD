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
        Schema::create('intellectual_property_right_subcategories', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->unsignedSmallInteger('intellectual_property_right_category_id');
            $table->string('name');

            $table->timestamps();

            $table->foreign('intellectual_property_right_category_id', 'intellectual_property_right_category_fk')->references('id')->on('intellectual_property_right_categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->unique(['intellectual_property_right_category_id', 'name'], 'intellectual_property_right_subcategories_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intellectual_property_right_subcategories');
    }
};
