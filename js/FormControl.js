var DAY_MONTH_CONSTRAINT = {
	"01":"31",
	"02":"28",
	"03":"31",
	"04":"30",
	"05":"31",
	"06":"30",
	"07":"31",
	"08":"31",
	"09":"30",
	"10":"31",
	"11":"30",
	"12":"31",
};


function inputDisplayValidInvalid(input,label) {
	if(!input.validity.valid) {

			input.className = "error"
			label.className = "error";
			label.textContent = input.title;
			if(input.validity.customError)
				label.textContent = input.customErrorMessage;
			if(input.validity.valueMissing)
				label.textContent = "Il campo '" + label.getAttribute("data-original") + "' è richiesto";
		}
		else {
			label.className = "success";
			input.className = "success"			
			label.textContent = label.getAttribute("data-original");
	}
}

function inputCheck(event,form) {
	var input = event.target;
	var label = form.querySelector("[for='" + input.id + "']");
		if(input.hasAttribute('data-match')) {
			var toMatchObjectId = input.getAttribute("data-match");
			var errorMessage = input.getAttribute("data-match-error");
			var valueToMatch = document.getElementById(toMatchObjectId).value;
			if(valueToMatch != input.value) {
				input.setCustomValidity(errorMessage);
				input.customErrorMessage = errorMessage;
			}
			else {
				input.setCustomValidity("");
				input.customErrorMessage = errorMessage;
			}
		}

		if(input.hasAttribute('data-date')) {
			var ddmmyyyy = input.value.split("/");
			var constraintFail = true;
			if(ddmmyyyy.length == 3 && ddmmyyyy[2].length == 4) {
				var year = parseInt(ddmmyyyy[2]);
				var day = parseInt(ddmmyyyy[0]);
				var month = ddmmyyyy[1];
				var isLeapYear = (year%4 == 0 && year%100 !=0) || (year%400 == 0);
				if(isLeapYear) DAY_MONTH_CONSTRAINT["02"] = 29;
				else DAY_MONTH_CONSTRAINT["02"] = 28;
				if(day <= parseInt(DAY_MONTH_CONSTRAINT[month]))
					constraintFail = false;

				if(constraintFail) {
					input.setCustomValidity("La data non esiste");
					input.customErrorMessage= "La data non esiste";
				} else {
					input.setCustomValidity("");
					input.customErrorMessage= "";
				}
			}
		}

		if(input.hasAttribute('data-query')) {
			var queryValue = input.value;
			var queryString = input.getAttribute("data-query");
			var queryError = input.getAttribute("data-query-error");
			var queryClient = new AsyncReq(queryString+queryValue,function(data) {
				if(data == 1) {
					input.setCustomValidity(queryError);
					input.customErrorMessage = queryError;
				}
				else input.setCustomValidity("");
				inputDisplayValidInvalid(input,label);
			});
			queryClient.GET([]);
		}

		inputDisplayValidInvalid(input,label);	
}


function FormControl(form) {
	var inputs = form.querySelectorAll("input, select");
	for(var i = 0; i < inputs.length; ++i) {
		var inputLabel = form.querySelector("[for='" + inputs[i].id + "']");
		if(!inputLabel) continue;
		inputLabel.setAttribute("data-original",inputLabel.textContent);
		inputs[i].oninput = function(event) {inputCheck(event,form);}
		inputs[i].onblur = inputs[i].oninput;
		//inputs[i].onpropertychange = inputs[i].onblur;
	}
}