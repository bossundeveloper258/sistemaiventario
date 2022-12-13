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
        Schema::table('cost_centers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('sede_id')->nullable()->change();
        });

        Schema::table('computers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('business_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('costcenters', function (Blueprint $table) {
            //
        });
    }
};
