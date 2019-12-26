<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloud', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('connection_name');
            $table->string('ip_address');
            $table->string('port');
            $table->string('username');
            $table->string('password');
            $table->string('directory')->nullable();
            $table->string('isactive');
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
        Schema::dropIfExists('cloud');
    }
}
