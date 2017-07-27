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



		<h2>RATE on {{ $selectedExperience->elem_name}}</h2>

		<h2>For Competency {{ $rate->primary_competency->competency}} </h2>

		<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#Reflect" aria-controls="Reflect" role="tab" data-toggle="tab">Reflect</a>
				</li>
				<li role="presentation">
					<a href="#Articulate" aria-controls="Articulate" role="tab" data-toggle="tab">Articulate</a>
				</li>
				<li role="presentation">
					<a href="#Translate" aria-controls="Translate" role="tab" data-toggle="tab">Translate</a>
				</li>
				<li role="presentation">
					<a href="#Evaluate" aria-controls="Evaluate" role="tab" data-toggle="tab">Evaluate</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="Reflect">
					<div class="form-group">
						{{ Form::label('response_component[reflect][response_text]', 'Response:', ['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-5">
							{{ Form::textarea('response_component[reflect][response_text]', $rate->filtered_response_component('reflect')->response_text, ['class'=>'form-control', 'cols'=>30, 'rows'=>10]) }}
						</div>
					</div>	
					<a class="btn btn-primary btnNext" >Move on to Articulate</a>
				</div>
				<div role="tabpanel" class="tab-pane" id="Articulate">
					<div class="form-group">
						{{ Form::label('response_component[articulate][response_text]', 'Articulate:', ['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-5">
							{{ Form::textarea('response_component[articulate][response_text]', $rate->filtered_response_component('articulate')->response_text, ['class'=>'form-control', 'cols'=>30, 'rows'=>10]) }}
						</div>
					</div>
					<a class="btn btn-primary btnPrevious" >Back to Reflect</a>
					<a class="btn btn-primary btnNext" >Move on to Translate</a>
				</div>
				<div role="tabpanel" class="tab-pane" id="Translate">
					<div class="form-group">
						{{ Form::label('response_component[translate][response_text]', 'Translate:', ['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-5">
							{{ Form::textarea('response_component[translate][response_text]', $rate->filtered_response_component('translate')->response_text, ['class'=>'form-control', 'cols'=>30, 'rows'=>10]) }}
						</div>
					</div>
					<a class="btn btn-primary btnPrevious" >Back to Translate</a>
					<a class="btn btn-primary btnNext" >Move on to Evaluate</a>
				</div>
				<div role="tabpanel" class="tab-pane" id="Evaluate">...</div>
			</div>
		</div>

		

		<div class="form-group">
			{{ Form::submit('Save Draft', array('name'=>'draft', 'class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('name'=>'submit', 'class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>

		{{ Form::close() }}
	</div>
</div>



@endsection

@section('footer')

<script>
	$('.btnNext').click(function(){
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	});

	$('.btnPrevious').click(function(){
		$('.nav-tabs > .active').prev('li').find('a').trigger('click');
	});
</Script>

@endsection