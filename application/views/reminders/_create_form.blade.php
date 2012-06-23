{{ Form::open('/', 'POST') }}
	<ul>
		<li>
			{{ Form::label('title', 'Title: ') }}<br>
			{{ Form::text('title', Input::old('title')) }}
			{{ $errors->first('title', '<span class="error">:message</span>') }}
		</li>

		<li>
			{{ Form::label('message', 'Your Reminder: ')}}<br>
			{{ Form::textarea('message', Input::old('message')) }}
			{{ $errors->first('message', '<span class="error">:message</span>') }}
		</li>

		<li>
			{{ Form::label('send-date', 'When Shall We Send It?') }}<br>
			{{ Form::date('send-date') }}
			{{ $errors->first('send-date', '<span class="error">:message</span>') }}			
		</li>

		<li>
			{{ Form::submit('Create Reminder') }}
		</li>
	</ul>

{{ Form::close() }}