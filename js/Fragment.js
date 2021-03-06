function Fragment(container,callback) {  // Oggetto per la navigazione a TAB nell'applicazione
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
	var curr = this;
	window.onkeydown = function(event) {
		var key = event.keyCode;
		switch(key) {
			case 39: curr.next(); break;
			case 37: curr.prev(); break;
		}
	}
}


Fragment.prototype.makeSelectors = function(nodeType) { // Creazione dei selettori a partire dai frammenti da mostrare
	with(this) {
		nodeType = nodeType || "a";
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

Fragment.prototype.makeShifters = function(nodeType,textNext,textPrev) { // Creazione di semplici pulsanti avanti/indietro
	with(this) {
		nodeType = nodeType || "a";
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
		index = (pointer+1) % queueSize;
		that(index);
	}
}

Fragment.prototype.prev = function() {
	with(this) {
		index = (pointer == 0) ? queueSize -1 : pointer - 1;
		that(index);
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

Fragment.prototype.onFragmentChange = function(index) {  // "evento" lanciato al cambio di tab.
														// si utilizza la local storage per salvare la posizione per visite future

	if(this.callback)
		this.callback(index);
	localStorage.setItem(location.href,index);
}