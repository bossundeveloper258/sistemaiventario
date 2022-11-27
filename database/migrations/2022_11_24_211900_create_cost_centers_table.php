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
        Schema::create('cost_centers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();

            // area
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')
              ->references('id')->on('areas')->onDelete('cascade');
              
            // sede
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')
              ->references('id')->on('sedes')->onDelete('cascade');
            
            // business
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')
              ->references('id')->on('businesses')->onDelete('cascade');

            // // brand
            // $table->unsignedBigInteger('brand_id');
            // $table->foreign('brand_id')
            //   ->references('id')->on('parameters')->onDelete('cascade');
            
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
        Schema::dropIfExists('cost_centers');
    }
};
