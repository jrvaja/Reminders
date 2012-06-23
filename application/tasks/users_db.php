<?php

class Users_Db_Task {
	public function seed()
	{
		DB::query('truncate table users');

		User::create([
			'first_name' => 'Jeffrey',
			'last_name'  => 'Way',
			'email'		 => 'jeffrey@envato.com',
			'password'   => Hash::make('1234')
		]);

		User::create([
			'first_name' => 'Allison',
			'last_name'  => 'Peterson',
			'email'		 => 'wayallie@gmail.com',
			'password'   => Hash::make('1234')
		]);
	}
}