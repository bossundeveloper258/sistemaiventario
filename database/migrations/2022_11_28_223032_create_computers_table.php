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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
              ->references('id')->on('parameters')->onUpdate('cascade');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')
                ->references('id')->on('parameters')->onUpdate('cascade');

            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')
                ->references('id')->on('parameters')->onUpdate('cascade');

            $table->string("number_serie")->nullable();
            $table->string("number_inventory")->nullable();
            $table->string("act_fijo")->nullable();
            $table->string("name");

            $table->unsignedBigInteger('so_id');
            $table->foreign('so_id')
                ->references('id')->on('parameters')->nullable();
            
            $table->string("cod_bitlocker")->nullable();
            $table->string("processor")->nullable();
            $table->string("ram")->nullable();
            $table->string("hdd")->nullable();
            $table->date("date_start_guarantee")->nullable();
            $table->date("date_exp_guarantee")->nullable();
            $table->date("date_capital")->nullable();

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
                ->references('id')->on('parameters')->onUpdate('cascade');

            $table->string("number_capex")->nullable();
            $table->string("name_capex")->nullable();
            $table->string("pep_number")->nullable();
            $table->string("solped")->nullable();
            $table->string("oc")->nullable();
            $table->string("pe_migo")->nullable();
            $table->string("factura")->nullable();
            $table->decimal("amount")->nullable();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                ->references('id')->on('parameters')->onUpdate('cascade');

            $table->unsignedBigInteger('ceco_id');
            $table->foreign('ceco_id')
                ->references('id')->on('cost_centers')->onUpdate('cascade');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                ->references('id')->on('employees')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')->nullable();

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
        Schema::dropIfExists('computers');
    }
};
