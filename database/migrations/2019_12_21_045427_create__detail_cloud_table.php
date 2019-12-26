<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCloudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_detail_cloud', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_cloud');
            $table->string('host_name');
            $table->string('operation_system');
            $table->string('cpu_speed');
            $table->string('memory_count');
            $table->string('disck_count');
            $table->string('country_server');
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
        Schema::dropIfExists('_detail_cloud');
    }
}
