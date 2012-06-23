{{ Form::open('/', 'POST') }}
	<ul>
		<li>
			{{ Form::label('title', 'Title: ') }}<br>
			{{ Form::text('title') }}
		</li>

		<li>
			{{ Form::label('message', 'Your Reminder: ')}}<br>
			{{ Form::textarea('message') }}
		</li>

		<li>
			{{ Form::label('send-date', 'When Shall We Send It?') }}<br>
			{{ Form::date('send-date') }}
		</li>

		<li>
			{{ Form::submit('Create Reminder') }}
		</li>
	</ul>
{{ Form::close() }}