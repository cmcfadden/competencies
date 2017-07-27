
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// TODO: cleanup
$("#typesOfCocurriculars").on("change", function() {
	$(".cocurricularDescriptorContainer").removeClass("hide");

});

$(".saveCocurricular").on("click", function() {

	$.post('/rate/createCocurricular', {cocurricularType: $("#typesOfCocurriculars").val(), cocurricularDescriptor: $("#cocurricularDescriptor").val()}, function(data, textStatus, xhr) {

		if(data.cocurricularId == undefined) {
			// TODO: alert an error
		}
		var ccId = data.cocurricularId;

		$("#cocurricular_experiences").append($('<option>', {
			value: ccId,
    		text: $("#cocurricularDescriptor").val(),
    		selected: true
		}));
		$("#cocurricular_experiences").trigger("change");
		$("#cocurriculars").removeClass("hide");
		$("#addCocurricular").collapse('hide');

	});


});


$(".experienceSelector").on("change", function() {
	$("#experience").val($(this).val());
});
