<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function(Blueprint $table)
        {
            $table->increments('Id');
            $table->char('Account', 32)->unique('Account');
            $table->char('Password', 64);
            $table->integer('AccountType')->unsigned()->default(0)->comment('0 = admin; 1 = editor');
            $table->integer('AccountStatus')->unsigned()->default(0)->comment('0 = active; 1 = deactive');
            $table->char('Email', 64);
            $table->string('Address', 200)->nullable();
            $table->string('Name', 200)->nullable();
            $table->char('Phone', 32)->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('account');
    }
}
