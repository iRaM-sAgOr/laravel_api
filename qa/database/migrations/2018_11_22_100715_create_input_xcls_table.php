<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputXclsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_xcls', function (Blueprint $table) {
          
            $table->increments('id');
            $table->string('host_name',100);
            $table->string('resource_name',100);
            $table->string('description',500);
            $table->string('model',100);
            $table->string('ip_address',100);
            $table->string('alias',100);
            $table->string('bandwidth',100);
            $table->string('resource',100);
            $table->double('average');
            $table->double('minimum');
            $table->double('maximum');
            $table->string('95th_percentile');
            $table->timestamps('last_update');
            $table->binary('check_bit');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_xcls');
    }
}
