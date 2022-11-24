<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Parameter;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->char("serie", 2)->default("PE");
            $table->text('address')->nullable();

            $table->unsignedBigInteger('sede_type_id');
            $table->foreign('sede_type_id')
              ->references('id')->on('parameters')->onDelete('cascade');

            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')
              ->references('id')->on('businesses')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
              ->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });

        DB::table('parameters')->insert(
            array(
                [
                    'parent'    =>   Parameter::SedeType, 
                    'description' => 'Centro Distribución',
                ],
                [
                    'parent'    =>   Parameter::SedeType, 
                    'description' => 'Planta',
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
};
