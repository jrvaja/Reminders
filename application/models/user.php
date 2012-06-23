<?php

class User extends Eloquent {
	public function reminders()
	{
		return $this->has_many('Reminder');
	}
}