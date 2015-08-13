
// Search box (at the top nav bar) for smaller screens

window.onload = function(){ 
	//Get submit button
	var submitbutton = document.getElementById("tfq2");
	//Add listener to submit button
	if(submitbutton.addEventListener){
		submitbutton.addEventListener("click", function() {
			if (submitbutton.value == 'Search'){//Customize this text string to whatever you want
				submitbutton.value = '';
			}
		});
	}
}
