<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('fullname');
            $table->string('id_user', 13)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('phone', 15)->unique();
            $table->string('streetAddress', 30)->nullable();
            $table->string('secundaryAddress', 30)->nullable();
            $table->string('terminado',1);

            //Ya aqui viene incluido tambien el estado
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('citys');

            $table->string('postCode', 10)->nullable();
            $table->string('registration_token')->nullable();
            $table->enum('role',['user','edit','admin']);



            $table->rememberToken();
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
        Schema::drop('users');
    }
}
