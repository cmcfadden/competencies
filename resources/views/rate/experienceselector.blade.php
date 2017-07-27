<p>Select an Experience</p>
			{{ Form::text("experience", $rate->experience, ["id"=>"experience"])}}
<div role="tabpanel">
	<!-- Nav pills -->
	<ul class="nav nav-pills" role="tablist">
		<li role="presentation" class="active">
			<a href="#courses" aria-controls="courses" role="tab" data-toggle="tab">Courses</a>
		</li>
		<li role="presentation">
			<a href="#cocurriculars" aria-controls="cocurriculars" role="tab" data-toggle="tab">Co-Curriculars</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="courses">
				
			<div class="form-group">
				{{ Form::label('course_experience', 'Experience:', ['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-4">
				{{ Form::select('course_experience', $courseExperiences, null, ['id'=>'course_experience', 'placeholder'=>"Select a Course", 'class' => 'experienceSelector form-control']) }}
				</div>
			</div>
		


		</div>
		<div role="tabpanel" class="tab-pane" id="cocurriculars">
			<div class="form-group 
			@if(count($cocurricularExperiences) ===0)
				hide
			@endif
			">
				{{ Form::label('cocurricular_experiences', 'Experience:', ['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-4">
				{{ Form::select('cocurricular_experiences', $cocurricularExperiences, null, ['class'=>'experienceSelector form-control', 'placeholder'=>"Select a Co-Curricular", 'id'=>'cocurricular_experiences']) }}
				</div>
			</div>
			@if(count($cocurricularExperiences) ===0)
				<p class="no-cocurriculars">You don't have any co-curriculars recorded - why not add one right now?</p>
			@endif

			<button type="button" data-toggle="collapse" data-target="#addCocurricular">Add Co-Curricular</button>
			


			<div id="addCocurricular" class="collapse">
				<div class="form-group">
					{{ Form::label('typesOfCocurriculars', 'Type of Co-Curricular:', ['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-4">
						{{ Form::select('typesOfCocurriculars', $typesOfCocurriculars, null, ['placeholder' => 'Select a Co-Curricular Type', 'id'=>'typesOfCocurriculars', 'class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group hide cocurricularDescriptorContainer">
					{{ Form::label('cocurricularDescriptor', 'Name of the Co-Curricular:', ['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-6">
						{{ Form::text("cocurricularDescriptor", null, ['size'=>40, 'class' => 'form-control', 'id'=>'cocurricularDescriptor'])}}
					</div>
				</div>

				<div class="form-group hide cocurricularDescriptorContainer">
					<div class="col-sm-offset-2 col-sm-6">
						<button type="button" class="saveCocurricular btn btn-primary">Save this Co-Curricular</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
