$("#add-more-notes").on('click', function(){
	console.log('add more notes');
});

$("#feedback_status").on('change', function(){
	console.log('send ajax to update status');
	updateStatus();
});

$("#feedback_category").on('change', function(){
	console.log('send ajax to update category');
	updateCategory();
});


var updateStatus = function(){
	var feedbackId = $("#feedbackID").val();
	var feedback_status_id = $("#feedback_status").val();

	console.log(feedback_status_id);
	$.ajax({
		type: "PATCH",
		url: '/admin/feedback/' + feedbackId,
		data: {'feedback_status_id' : feedback_status_id },
		dataType: 'json'
	}).done(function(response){
			console.log(response);	
	});
	return;
}

var updateCategory = function(){
	var feedbackId = $("#feedbackID").val();
	var feedback_category_id = $("#feedback_category").val();

	console.log(feedback_category_id);
	$.ajax({
		type: "PATCH",
		url: '/admin/feedback/' + feedbackId,
		data: {'feedback_category_id' : feedback_category_id },
		dataType: 'json'
	}).done(function(response){
			console.log(response);	
	});
	return;
}
