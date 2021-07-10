<?php
class UserTableSeeder extends Seeder{
	public function run(){
		DB::table('users')->delete();
		User::create(array(
			'name'=>'DAO TIEN TU',
			'username'=>'admin',
			'password'=>Hash::make('admin'),
			'email'=>'daotientu@gmail.com'
		));
	}
}
?>