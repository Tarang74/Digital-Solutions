$(".alpha-only").on("keydown", function(event){
	// Ignore controls such as backspace
	var arr = [8,16,17,20,35,36,37,38,39,40,45,46];

	// Allow letters
	for(var i = 65; i <= 90; i++){
		arr.push(i);
	}

	if(jQuery.inArray(event.which, arr) === -1){
		event.preventDefault();
	}
});

$(".alpha-only").on("input", function(){
		var regexp = /[^a-zA-Z]/g;
		if($(this).val().match(regexp)){
			$(this).val( $(this).val().replace(regexp,'') );
		}
});