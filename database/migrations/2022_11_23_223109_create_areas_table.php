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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();

            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')
              ->references('id')->on('businesses')->onDelete('cascade');

            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')
              ->references('id')->on('sedes')->onDelete('cascade');
              
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
        Schema::dropIfExists('areas');
    }
};
