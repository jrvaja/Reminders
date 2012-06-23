@layout('layout')

@section('content')
	<h1>Create Reminder</h1>
	{{ render('reminders._create_form'); }}
@endsection