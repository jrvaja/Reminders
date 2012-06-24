<?php

class Email {
	protected $transport;
	protected $email_settings;
	protected $mailer;

	public function __construct()
	{
		$this->email_settings = include('email.config');

		$this->transport = Swift_SmtpTransport::newInstance($this->email_settings['smtp'], $this->email_settings['smtp_port'], 'ssl')
				->setUsername($this->email_settings['username'])
				->setPassword($this->email_settings['password']);

		$this->mailer = Swift_Mailer::newInstance($this->transport);
	}

	public function send_reminder($message)
	{
		$message = Swift_Message::newInstance($message->title)
					->setFrom([$this->email_settings['username'] => 'Reminders.dev'])
					->setTo([$message->email => "{$message->first_name} {$message->last_name}"])
					->setBody($this->email_settings['template']($message), 'text/html');

		// Send the message
		$this->mailer->send($message);
	}
}