<?php

class User extends Aware {
	public static $rules = [
		'first_name' => 'required',
		'last_name'  => 'required',
		'email'      => 'required|email',
		'password'   => 'required'
	];

	public function reminders()
	{
		return $this->has_many('Reminder');
	}
}