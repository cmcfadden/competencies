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
	<h1>RATE Assignment</h1>

</div>


<div class="row">
	<div class="col-md-12">
	@isset($rateAssignment)
	{{ Form::model($rateAssignment, array('route' => ['rateassignment.update', $rateAssignment->id], 'class'=>'form-horizontal', 'method'=>'PATCH')) }}
	@else
	{{ Form::model($rateAssignment = new \App\Models\RateAssignment, array('route' => 'rateassignment.store', 'class'=>'form-horizontal')) }}
	@endisset
		
		<div class="form-group">
			{{ Form::label('assignment_title', 'Assignment Title:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-5">
				{{ Form::text('assignment_title', null, ['class'=>'form-control']) }}
			</div>
		</div>	

		<div class="form-group">
			{{ Form::label('target_email', 'Target Email:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-5">
				{{ Form::email('target_email', null, ['class'=>'form-control']) }}
			</div>
		</div>	
		{{Form::hidden('active',0)}}
		<div class="form-group">
			{{ Form::label('active', 'Active:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-5">
				{{ Form::checkbox('active', 1, null, ['class'=>'form-control']) }}
			</div>
		</div>	

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>
	
	{{ Form::close() }}
	</div>
</div>


@endsection