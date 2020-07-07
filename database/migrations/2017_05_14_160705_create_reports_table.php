<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->index();
            $table->integer('abuse_type_id')->index();
            $table->string('abuse_type_other')->nullable();
            $table->string('abuser');
            $table->mediumText('description');
            $table->string('from_ip')->nullable();
            $table->string('from_country')->nullable();
            $table->string('from_country_code')->nullable();
            $table->string('from_host')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
