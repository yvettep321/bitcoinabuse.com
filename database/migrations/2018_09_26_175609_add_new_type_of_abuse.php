<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTypeOfAbuse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert abuse types
        DB::table('abuse_types')->insert([[
                'id'    => 4,
                'label' => 'blackmail scam',
                'order' => 15,
            ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('abuse_types')->where('id', 4)->delete();
    }
}
