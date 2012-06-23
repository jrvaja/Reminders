@layout('layout')


@section('content')
	<h2> Your Reminders</h2>

	<ul>
	@foreach ($reminders as $r)
		<li>
			{{ HTML::link("{$r->id}", $r->title) }}
		</li>
	@endforeach
	</ul>

	<h2> Create </h2>
	@if ( Session::has('flash') )
		<p class="success">{{ Session::get('flash') }}</p>
	@endif

	<?php echo render('reminders._create_form'); ?>
@endsection