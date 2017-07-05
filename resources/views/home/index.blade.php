@extends('base')


@section('content')

@if ($flashContent)
<div class="alert">
    {!! $flashContent !!}
</div>    
@endif

<div class="row">
	<div class="col-sm-12">
		What would you like to do?
	</div>
</div>

<div class="row">

	<div class="col-sm-4">
		<p><a href="{{ action('RateController@capture') }}" class="btn btn-primary">Capture an Experience</a></p>
		<p><a href="{{ action('RateController@index') }}">View Past Experiences</a></p>
		<p>With so much going on, it can be hard to remember what you did yesterday, let alone last year.  Capture an experience so you can refer to it when preparing for interviews and internships</p>
	</div>

	<div class="col-sm-4">
		<p><a href="{{ action('EvaluateController@create') }}" class="btn btn-primary">Check my Progress</a></p>
		<p><a href="{{ action('EvaluateController@index') }}">View Past Progress</a></p>
		<p>Whether you’re taking a course, participating in a co-curriculars, or going on an adventure with your friends, all of your experiences contribute to your growth. Check your progress to see how it’s going.</p>
	</div>

	<div class="col-sm-4">
		<p><a href="{{ action('RateController@prepare') }}" class="btn btn-primary">Prepare for an Interview</a></p>
		<p><a href="{{ action('RateController@index') }}">View Past Responses</a></p>
		<p>Use your captured experiences and
all of your skills in the core 
competencies to nail an interview
question.</p>

	</div>
</div>



@endsection