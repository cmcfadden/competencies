@extends('base')


@section('content')

@if ($errors->any())
<div class="alert">
	<ul>
		{!! implode('', $errors->all('<li class="error">:message</li>')) !!}
	</ul>
</div>    
@endif

<div class="page-header">
	<h1>RATE!  Classic Type!</h1>

</div>

<div class="row">
	<div class="col-md-12">
		@isset($rate)
		{{ Form::model($rate, array('route' => ['rate.update', $rate->id], 'class'=>'form-horizontal', 'method'=>'PATCH')) }}
		@else
		{{ Form::model($rate = new \App\Models\RateResponse, array('route' => 'rate.store', 'class'=>'form-horizontal')) }}
		@endisset
		

		{{form::hidden("rate_assignment", isset($rateAssignment)?$rateAssignment->id:null)}}
		{{form::hidden("classic_rate", "1")}}

		<div class="form-group">
			{{ Form::label('primary_competency_id', 'Competency:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-4">
				{{ Form::select('primary_competency_id', $competencies, null, ['id'=>'available_competencies', 'class' => 'form-control']) }}
			</div>
		</div>
		
		@include('rate.experienceselector')

		<div class="form-group">
			{{ Form::submit('Start RATE', array('class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>

		{{ Form::close() }}
	</div>
</div>



@endsection

@section('footer')

<script src="{{ asset('/js/experienceManager.js') }}"></script>


@endsection