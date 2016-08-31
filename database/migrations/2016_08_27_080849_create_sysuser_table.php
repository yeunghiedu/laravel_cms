<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sysuser', function(Blueprint $table)
        {
            $table->increments('Id');
            $table->char('UserName', 32);
            $table->char('Password',64);
            $table->string('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sysuser');
    }
}
