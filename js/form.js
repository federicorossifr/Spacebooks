function Form(formId) {
	this.form = document.getElementById(formId);
	this.formControls = this.form.querySelectorAll("input, textarea, select");
	this.controlsCount = 0; //number of formControls that have to be validated
	this.submitButton = this.form.querySelector("button[type='submit']");
	this.inputs = [];
	this.controlsValid = 0; //number of formControls already validated
	this.form.reset();
	for(var i = 0; i < this.formControls.length; ++i) {
		var name = this.formControls[i].getAttribute("name");
		this.inputs[name] = this.formControls[i];
	}	
}

Form.prototype.parseControl = function(obj) {
		var regResult = obj.constraint.test(obj.value);

		if(regResult && !obj.success) {
			this.controlsValid++;
			obj.success = 1;
			if(obj.watcher) {
				obj.watcher.className = "success";
			}
		}

		if(!regResult && obj.success) {
			this.controlsValid--;
			obj.success = 0;

			if(obj.watcher) {
				if(obj.watcher.hasAttribute("data-message"))
					obj.watcher.className ="errormsg";
				else
					obj.watcher.className = "error";
			}
		}
			
		this.submitButton.disabled = !(this.controlsValid == this.controlsCount);
}

Form.prototype.addConstraint = function(inputName,constraint) {
		this.submitButton.disabled = 1;
		if(this.inputs[inputName]) {
			var inputControl = this.inputs[inputName];
			inputControl.constraint = constraint;
			inputControl.watcher = this.form.querySelector("label[for='" + inputControl.id  + "']");
			inputControl.watcher.className = "error";
			inputControl.success = 0;

			this.controlsCount++;
			var curr = this; // aliasing "this" to prevent shadowing in next instruction
			this.parseControl(inputControl);

			inputControl.addEventListener("input",function() {
				curr.parseControl(this);
			});


		}
}

Form.prototype.addMutualConstraint =  function(inputA,inputB) {
		this.submitButton.disabled = 1;
		if(this.inputs[inputA] && this.inputs[inputB]) {
			this.controlsCount++;
			var a = this.inputs[inputA];
			var b = this.inputs[inputB];
			a.match = 0;
			b.match = 0;
			b.watcher = this.form.querySelector("label[for='" + b.id + "']");
			b.watcher.className = "error";
			var curr = this;
			b.oninput = function() {
				if(b.value == a.value && !b.match && b.value != "") {
					curr.controlsValid++;
					b.match = 1;
					a.match = 1;
					b.watcher.className = "success";
				}

				if(b.value != a.value && b.match) {
					curr.controlsValid--;
					b.match = 0;
					a.match = 0;
					b.watcher.className = "error";

				}
				curr.submitButton.disabled = !(curr.controlsValid == curr.controlsCount);
			}
			a.oninput = b.oninput;
		}
}

Form.prototype.addConstraintExtension = function(url,paramName,inputName,trueValue,message) {
	if(this.inputs[inputName]) {
		var inputControl = this.inputs[inputName];
		var curr = this; // aliasing "this" to prevent shadowing in next instruction

		inputControl.oninput = function() {
			var obj = this;
			var params = [{"id":paramName,"value": obj.value }];


			var asyncCheck = new AsyncReq(url,function(data) {
				if(data != trueValue && obj.success) {
					curr.controlsValid--;
					obj.success = 0;

					if(obj.watcher)
						obj.watcher.className = "errormsg";
						obj.watcher.setAttribute("data-message",message);
				}
				curr.submitButton.disabled = !(curr.controlsValid == curr.controlsCount);
			});

			
			asyncCheck.GET(params);
		}
	}
}