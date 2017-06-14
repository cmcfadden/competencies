$(document).on("change", '.competencySelector', function(e) {
	axios.get('/evaluate/getEvaluatorsForCompetency/' + $(e.currentTarget).val())
  	.then(function (response) {
  		$(".evaluationBlock").html(response.data);
  		$(".evaluationBlock").find("input").each(function(key, value) {
  			$(value).slider({});
  		});
  })
  .catch(function (error) {
    alert("an error occured. Please try again")
  });
});