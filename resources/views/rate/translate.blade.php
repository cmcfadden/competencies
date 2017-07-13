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
	<h1>Prepare for an Interview</h1>

</div>


<div class="row">
	<div class="col-md-12">
		@isset($rate)
		{{ Form::model($rate, array('route' => ['rate.update', $rate->id], 'class'=>'form-horizontal', 'method'=>'PATCH')) }}
		@else
		{{ Form::model($rate = new \App\Models\RateResponse, array('route' => 'rate.store', 'class'=>'form-horizontal')) }}
		@endisset
		
		<div class="form-group">
			{{ Form::label('available_competencies', 'Competency:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-4">
				{{ Form::select('available_competencies', $competencies, null, ['id'=>'available_competencies', 'class' => 'form-control']) }}
			</div>
		</div>
		{{ Form::text('primaryCompetency') }}
		
		
		<div class="form-group hide rate_responses-select">
			{{ Form::label('experience', 'Experience:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-4">
				{{ Form::select('experience',array(), null, ['id'=>'rate_responses', 'class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group hide no-rate_responses">
			<label class="col-sm-2 control-label">Experience: </label>
			<div class="col-sm-10">
				<p class="form-control-static error-dialog"></p>
			</div>
		</div>

		<div class="form-group reflectContent">

		</div>

		{{ Form::text('rate_response', $rate->id) }}

		<div class="form-group hide">
			{{ Form::label('response_component[translate][response_text]', 'Response:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-5">
				{{ Form::textarea('response_component[translate][response_text]', $rate->filtered_response_component('translate')->response_text, ['class'=>'form-control', 'cols'=>30, 'rows'=>10]) }}
			</div>
		</div>	

		{{ Form::text('response_component[translate][id]', $rate->filtered_response_component('translate')->id, []) }}

		{{ Form::text('response_component[translate][descriptor_id]', $rate->filtered_response_component('translate')->descriptor_id, ['id'=>'descriptor_id']) }}

		<div class="form-group descriptor hide">
			<div class="col-sm-5 question">
			</div>
			<div class="col-sm-3">
				<button class="randomizeDescriptor">Pick a new Descriptor</button>
			</div>
		</div>
		
		<div class="form-group translate hide">
			{{ Form::label('response_component[translate][response_text]', 'Response:', ['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-5">
				{{ Form::textarea('response_component[translate][response_text]', $rate->filtered_response_component('translate')->response_text, ['class'=>'form-control', 'cols'=>30, 'rows'=>10]) }}
			</div>
		</div>	

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary col-sm-offset-2')) }}
		</div>

		{{ Form::close() }}
	</div>
</div>



@endsection

@section('footer')

<script>

	$("#available_competencies").on("change", function(evt) {
		targetField = evt.target;
		competencyId = $(targetField).val();
		$("[name=primaryCompetency]").val(competencyId);
		$.get('/rate/getExperiencesForCompetency/' + competencyId, function(data) {
			if(data.length == 0) {
				$(".no-rate_responses .error-dialog").html("You don't have any captured experiences for this competency");
				$(".no-rate_responses").removeClass("hide");
				$(".rate_responses-select").addClass("hide");
				return;
			}
			$("#rate_responses").find('option').remove();
			$("#rate_responses").append("<option>Select a Experience<option");
			$.each(data, function(index, val) {
				$("#rate_responses").append($('<option>', {value:val.id, text:val.experience}));
				$(".rate_responses-select").removeClass("hide");
				$(".no-rate_responses").addClass("hide");
			});
		});
	});
	var descriptors = null;
	$("#rate_responses").on("change", function(evt) {
		targetField = $(evt.target);
		if(!(targetField.val() > 0)) {
			return;
		}
		$("[name=rate_response]").val(targetField.val());
		

		getReflection();
		loadDescriptors();
		
	});

	var loadDescriptors = function() {
		$.get('/rate/getDescriptorForCompetency/' + $("[name=primaryCompetency]").val(), function(data) {
			descriptors = data;
			if($.isNumeric($("#descriptor_id").val())) {
				$(descriptors).each(function(index, el) {
					if(el.id == $("#descriptor_id").val()) {
						$(".descriptor .question").html(el.descriptor_as_question);
					}
				});
			}
			else {
				randomDescriptor();	
			}
			
			$(".descriptor").removeClass("hide");
			$(".translate").removeClass("hide");
		});
	};

	var getReflection = function () {
		rateResponse = $("[name=rate_response]").val();
		$.get('/rate/getReflectionForRateResponse/' + rateResponse, function(data) {
			$(".reflectContent").html(data);
		});
	}

	var randomDescriptor = function() {
		selectedDescriptor = descriptors.getRandomVal();
		$(".descriptor .question").html(selectedDescriptor.descriptor_as_question);
		$("#descriptor_id").val(selectedDescriptor.id);
	}

	$(".randomizeDescriptor").on("click", function(e) {
		e.preventDefault();
		randomDescriptor();
	});

	Array.prototype.getRandomVal = function(){
	    return this[Math.floor(Math.random()*this.length)];
	};


	$(document).ready(function() {
		if($.isNumeric($("#descriptor_id").val())) {
			// $(".descriptor .question").html("NEED TO FILL THIS IN BOYEE");
			$(".descriptor").removeClass("hide");
			$(".translate").removeClass("hide");
			loadDescriptors();
			getReflection();
		}
		
		


	});

</script>


@endsection