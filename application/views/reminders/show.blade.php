{{ Form::open("$reminder->id", 'PUT')}}
	<p> {{ Form::text('title', $reminder->title) }}
	<p> {{ Form::textarea('message', $reminder->message) }}
    <p> {{ Form::date('send-date', $reminder->send_date) }}
    <p>
    	{{ Form::submit('Update') }}
    	{{ HTML::link('/', 'Cancel') }}
{{ Form::close() }}