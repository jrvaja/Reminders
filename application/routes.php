<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('login', function()
{
	return View::make('login');
});

Route::post('login', function() {
	$email = Input::get('email');
	$password = Input::get('password');

	if ( Auth::attempt(['username' => $email, 'password' => $password]) ) {
		return Redirect::to('/');
	} else {
		return Redirect::to('login')->with('login_errors', true);
	}
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('login');
});

// reminders
Route::get('/', ['before' => 'auth', function() {
	$data = [];

	$data['reminders'] = User::find(Auth::user()->id)->reminders;
	return View::make('reminders.index', $data);
}]);

// New Reminder
Route::get('new', function() {
	return View::make('reminders.new');
});

// Create Reminder
Route::post('/', function() {
	$reminder = new Reminder;
	$reminder->title = Input::get('title');
	$reminder->user_id = Auth::user()->id;
	$reminder->message = Input::get('message');
	$reminder->send_date = Input::get('send-date');
	$reminder->save();

	return Redirect::to('/')->with('flash', 'Your reminder has been scheduled!');
});

// Show Reminder
Route::get('(:num)', function($reminder_id) {
	$reminder = Reminder::find((int)$reminder_id);

	if ( !$reminder || $reminder->user_id !== Auth::user()->id ) {
		return Redirect::to('/');
	}
	
	return View::make('reminders.show')->with('reminder', $reminder);
});


// Update Reminder
Route::put('(:num)', function($reminder_id) {
	$reminder = Reminder::find($reminder_id);
	$reminder->title = Input::get('title');
	$reminder->message = Input::get('message');
	$reminder->send_date = Input::get('send-date');
	$reminder->save();

	return Redirect::to('/')->with('flash', 'Your reminder has been updated!');
});
/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});