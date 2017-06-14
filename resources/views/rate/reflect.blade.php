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
	<h1>Capture your Experience</h1>

</div>


<div class="row">
	<div class="col-md-12">
	@isset($rate)
	{{ Form::model($rate, array('route' => ['rate.update', $rate->id], 'class'=>'form-horizontal', 'method'=>'PATCH')) }}
	@else
	{{ Form::model($rate = new \App\Models\RateResponse, array('route' => 'rate.store', 'class'=>'form-horizontal')) }}
	@endisset
		<div class="form-group">
			{{ Form::label('umnDID', 'umnDID:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-10">
				{{ Form::text('umnDID') }}
			</div>
		</div>
		
		<div class="form-group">
			{{ Form::label('primaryCompetency', 'Competency:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-4">
				{{ Form::select('primaryCompetency', $competencies, null, ['class' => 'form-control']) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('competencies[]', 'Competencies:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-4">
				{{ Form::select('competencies[]', $competencies, null, ['multiple'=>'multiple', 'class' => 'form-control']) }}
			</div>
		</div>
	
		<div class="form-group">
			{{ Form::label('response_component[reflect][response_text]', 'Response:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-5">
				{{ Form::textarea('response_component[reflect][response_text]', $rate->filtered_response_component('reflect')->response_text, ['class'=>'form-control', 'cols'=>30, 'rows'=>10]) }}
			</div>
		</div>	



		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>
	
	{{ Form::close() }}
	</div>
</div>


@endsection