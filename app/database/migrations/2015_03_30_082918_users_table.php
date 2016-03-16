<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('email');
			$table->string('username');
			$table->string('password', 60);
			$table->string('name');
			$table->string('netsuite_password');
			$table->integer('netsuite_role');
			$table->integer('branch_id');
			$table->integer('role_id');
			$table->string('remember_token', 100)->nullable();
			$table->integer('inactive');
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
