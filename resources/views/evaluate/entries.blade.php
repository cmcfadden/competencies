
@foreach ($competency->descriptors as $descriptor)

	<div>

{{ Form::text('evaluation_entries[' . $descriptor->id . ']', null, ["disable",'class'=>'form-control', 
	"data-provide"=>"slider",
	"data-slider-enabled"=>"true", // toggle this once we have a finished status
	"data-slider-ticks"=>"[1, 2, 3, 4, 5]",
	"data-slider-ticks-labels"=>'["short", "medium", "long"]',
	"data-slider-min"=>"1",
	"data-slider-max"=>"5",
	"data-slider-step"=>"1",
	"data-slider-value"=>isset($evaluation)?$evaluation->evaluation_entry_for_descriptor($descriptor)->response:0,
	"data-slider-tooltip"=>"hide"]) }}
	</div>
@endforeach

