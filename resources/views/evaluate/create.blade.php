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
	<h1>Measure your Experience</h1>

</div>


<div class="row">
	<div class="col-md-12">
	@isset($evaluation)
	{{ Form::model($evaluation, array('route' => ['evaluate.update', $evaluation->id], 'class'=>'form-horizontal', 'method'=>'PATCH')) }}
	@else
	{{ Form::model($evaluation = new \App\Models\Evaluation, array('route' => 'evaluate.store', 'class'=>'form-horizontal')) }}
	@endisset
		<div class="form-group">
			{{ Form::label('competency_id', 'Competencies:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-4">
				{{ Form::select('competency_id', $competencies, null, ['class' => 'form-control competencySelector', $evaluation->competency_id!=null?"disabled":null]) }}
			</div>
		</div>
		
		<div class="evaluationBlock">
		
		@unless($evaluation->evaluation_entries->isEmpty())
			@include('evaluate.entries', ['competency' => $evaluation->competency, 'evaluation'=>$evaluation])
		@endif

		</div>
		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>
	
	{{ Form::close() }}
	</div>
</div>

@endsection

@section('footer')

<script src="{{ asset('/js/evaluationEntries.js') }}"></script>

@endsection
