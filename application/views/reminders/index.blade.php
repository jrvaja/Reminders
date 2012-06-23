@layout('layout')


@section('content')
	<h2> Your Reminders</h2>

	<ol>
	@foreach ($reminders as $r)
		<li>
			{{ HTML::link("{$r->id}", $r->title) }} -
			<span class="date">To Be Sent On: {{ date('Y-m-d', strtotime($r->send_date)) }}</span>
		</li>
	@endforeach
	</ol>

	<h2> Create </h2>
	@if ( Session::has('flash') )
		<p class="success">{{ Session::get('flash') }}</p>
	@endif

	<?php echo render('reminders._create_form'); ?>
@endsection