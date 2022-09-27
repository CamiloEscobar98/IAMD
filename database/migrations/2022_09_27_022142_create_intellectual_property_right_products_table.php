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
        Schema::create('intellectual_property_right_products', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedMediumInteger('intellectual_property_right_subcategory_id');
            $table->string('name');

            $table->timestamps();

            $table->foreign('intellectual_property_right_subcategory_id', 'intellectual_property_right_subcategory_fk')->references('id')->on('intellectual_property_right_subcategories')->cascadeOnUpdate()->restrictOnDelete();
            $table->unique(['intellectual_property_right_subcategory_id', 'name'], 'intellectual_property_right_products_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intellectual_property_right_products');
    }
};
