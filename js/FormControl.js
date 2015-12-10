function inputDisplayValidInvalid(input,label) {
	if(!input.validity.valid) {
			input.style.backgroundColor ="red";
			label.className = "error";
			label.textContent = input.title;
			if(input.validity.customError)
				label.textContent = input.customErrorMessage;
			input.style.color = "white";
		}
		else {
			input.style.backgroundColor = "green";
			label.className = "success";
			label.textContent = label.getAttribute("data-original");
			input.style.color="white";
	}
}

function inputCheck(event,form) {
	var input = event.target;
	var label = form.querySelector("[for='" + input.id + "']");
		
		if(input.hasAttribute('data-match')) {
			var toMatchObjectId = input.getAttribute("data-match");
			var valueToMatch = document.getElementById(toMatchObjectId).value;
			if(valueToMatch != input.value)
				input.setCustomValidity("Le password non coincidono");
			else
				input.setCustomValidity("");
		}

		if(input.hasAttribute('data-query')) {
			var queryValue = input.value;
			var queryString = input.getAttribute("data-query");
			var queryError = input.getAttribute("data-query-error");
			console.log(queryString);
			var queryClient = new AsyncReq(queryString+queryValue,function(data) {
				if(data == 1) {
					input.setCustomValidity(queryError);
					input.customErrorMessage = queryError;
				}
				else input.setCustomValidity("");
				inputDisplay(input,label);
			});
			queryClient.GET([]);
		}

		inputDisplayValidInvalid(input,label);	
}


function FormControl(form) {
	var inputs = form.querySelectorAll("input");
	for(var i = 0; i < inputs.length; ++i) {
		var inputLabel = form.querySelector("[for='" + inputs[i].id + "']");
		inputLabel.setAttribute("data-original",inputLabel.textContent);
		inputs[i].oninput = function(event) {inputCheck(event,form);}
		inputs[i].onblur = inputs[i].oninput;
	}
}