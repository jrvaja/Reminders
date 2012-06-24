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
		return DB::query('SELECT title, message, email, users.first_name, users.last_name  
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
			$email_settings = include('email.config');

			// Create the Transport
			$transport = Swift_SmtpTransport::newInstance($email_settings['smtp'], $email_settings['smtp_port'], 'ssl')
				->setUsername($email_settings['username'])
				->setPassword($email_settings['password']);

			foreach($reminders as $reminder) {
				$mailer = Swift_Mailer::newInstance($transport);

				$message = Swift_Message::newInstance($reminder->title)
					->setFrom(array('jeffrey@envato.com' => 'Reminders.dev'))
					->setTo(array($reminder->email => $reminder->first_name . ' ' . $reminder->last_name))
					->setBody($email_settings['template']($reminder), 'text/html');

				// Send the message
				$result = $mailer->send($message);
			}

			return 'Messages have been sent.';
		} else {
			return 'No reminders today.';
		}
	}
}