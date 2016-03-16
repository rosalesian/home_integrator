<?php 
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		User::create(array(
			'name'=>'Super Administrator',
			'username'=>'superadmin',
			'email'=>'brianestavilla@gmail.com',
			'password'=>Hash::make('superadmin'),
			'role_id'=>1,
			'netsuite_role'=>3,
			'netsuite_password'=>'March21993'
			));
		Role::create(array(
			'rolename'=>'Administrator'	
			));
	}
}
