<?php

class Reminder extends Eloquent {

	public function user()
	{
		return $this->belongs_to('User');
	}

	/*
	|--------------------------------------------------------------------------
	| Fetch all reminders that are scheduled to be sent today.
	|--------------------------------------------------------------------------
	*/
	public static function find_todays_reminders()
	{
		// Get all of today's reminders
		return DB::query('SELECT reminders.id, title, message, email, users.first_name, users.last_name  
						  FROM reminders 
						  INNER JOIN users
						  ON reminders.user_id = users.id 
						  WHERE DATE(send_date) = CURRENT_DATE()');
	}

	/*
	|--------------------------------------------------------------------------
	| Filter through a set of reminders, and send notifications.
	|--------------------------------------------------------------------------
	*/
	public static function notify($reminders)
	{
		if ( !empty($reminders) ) {
			$email = new Email;
			foreach($reminders as $reminder) {
				$email->send_reminder($reminder);
				Reminder::find($reminder->id)->delete();
			}
			return 'Messages have been sent.';
		}
		return 'No reminders today.';
	}
}