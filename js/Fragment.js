function Fragment(container,callback) {
	this.container = document.getElementById(container);
	this.container.className += " fragmentContainer";
	this.fragments = this.container.querySelectorAll("*[data-fragment]");
	this.controllerBar = document.createElement("div");
	this.controllerBar.className = "controllerBar";
	this.queueSize = this.fragments.length;
	this.pointer = 0;
	this.callback = callback;
	with(this) {
		for(var index in fragments) {
			if(!isNaN(index) && index != pointer) {
				fragments[index].style.display = "none";
			}
		}
	}


}


Fragment.prototype.makeSelectors = function(nodeType) {
	with(this) {
		for(var index = 0; index < fragments.length && !isNaN(index); ++index) {
			var frgBtn = document.createElement(nodeType);
			frgBtn.className = "controller";
			if(index == pointer) frgBtn.className += " active";
			frgBtn.setAttribute("data-toggle",index);
			var btnLabel = document.createTextNode(fragments[index].getAttribute("data-name"));
			frgBtn.appendChild(btnLabel);
			frgBtn.onclick = function() {that(this.getAttribute("data-toggle"));}
			controllerBar.appendChild(frgBtn);
		}
		container.insertBefore(controllerBar,fragments[0]);
		return  controllerBar;
	}
}

Fragment.prototype.makeShifters = function(nodeType,textNext,textPrev) {
	with(this) {

		var nextButton = document.createElement(nodeType);
		var prevButton = document.createElement(nodeType);
		var nextLabel = document.createTextNode(textNext);
		var prevLabel = document.createTextNode(textPrev);

		nextButton.appendChild(nextLabel);
		prevButton.appendChild(prevLabel);

		nextButton.setAttribute("data-role","nextFragment");
		prevButton.setAttribute("data-role","prevFragment");

		nextButton.className = "controller";
		prevButton.className = "controller";

		nextButton.onclick = function() {next()};
		prevButton.onclick = function() {prev()};

		controllerBar.appendChild(nextButton);
		controllerBar.insertBefore(prevButton,controllerBar.firstChild);
	}
}

Fragment.prototype.next = function() {
	with(this) {
		var btns = controllerBar.querySelectorAll("*[data-toggle]");
		btns[pointer].className = "controller";

		fragments[pointer].style.display = "none";
		pointer = (pointer+1) % queueSize;
		fragments[pointer].style.display = "block";
		if(onFragmentChange) onFragmentChange(pointer);


		btns[pointer].className = "controller active";
	}
}

Fragment.prototype.prev = function() {
	with(this) {
		var btns = controllerBar.querySelectorAll("*[data-toggle]");
		btns[pointer].className = "controller";

		fragments[pointer].style.display = "none";
		pointer = (pointer == 0) ? queueSize -1 : pointer - 1;
		fragments[pointer].style.display = "block";
		if(onFragmentChange) onFragmentChange(pointer);


		btns[pointer].className = "controller active";

	}
}

Fragment.prototype.that = function(index) {
	with(this) {
		var btns = controllerBar.querySelectorAll("*[data-toggle]");
		btns[pointer].className = "controller";

		fragments[pointer].style.display = "none";
		pointer = (index < queueSize) ? index : 0;
		fragments[pointer].style.display = "block";
		if(onFragmentChange) onFragmentChange(index);

		btns[pointer].className = "controller active";

	}
}

Fragment.prototype.loadState = function() {
	var last = localStorage.getItem(location.href);
	if(last) this.that(last);
}

Fragment.prototype.onFragmentChange = function(index) {
	if(this.callback)
		this.callback(index);
	localStorage.setItem(location.href,index);
}