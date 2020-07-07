<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbuseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abuse_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->integer('order'); 
        });

        // Insert abuse types
        DB::table('abuse_types')->insert([[
                'id'    => 1,
                'label' => 'ransomware',
                'order' => 10,
            ],[
                'id'    => 2,
                'label' => 'darknet market',
                'order' => 20,
            ],[
                'id'    => 3,
                'label' => 'bitcoin tumbler',
                'order' => 30,
            ],[
                'id'    => 99, // 99 is important here. It is used in our validation rules.
                'label' => 'other',
                'order' => 100,
            ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abuse_types');
    }
}
