<h1>Login</h1>

@if (Session::has('login_errors') )
	<p class="error">There were errors with your supplied login credentials.</p>
@endif

{{ Form::open('login', 'POST') }}
	<ul>
		<li>
			{{ Form::label('email', 'Email Address: ') }}
			{{ Form::text('email', Input::old('email')) }}
		</li>

		<li>
			{{ Form::label('password', 'Password: ') }}
			{{ Form::password('password') }}
		</li>
		<li>
			{{ Form::submit('Login') }}
		</li>
	</ul>
{{ Form::close() }}