function Pophover(item,title,text,onok) {
	this.launcher = item

	this.pop = document.createElement("div");

	this.pop.appendChild(this.makeTitle(title));
	this.pop.appendChild(this.makeText(text));
	this.pop.appendChild(this.makeClose(onok));
	this.pop.className = "popper";
	this.pop.style.position = "absolute";

	this.pop.style.top = this.launcher.offsetTop + 20 + 'px';
	this.pop.style.left = this.launcher.offsetLeft +  20 + 'px';

	document.body.appendChild(this.pop);
	this.hide();
}

Pophover.prototype.makeClose = function(onok) {
	var close = document.createElement("a");
	close.className = "prettyButton";
	close.textContent = "OK";
	var curr = this;
	close.onclick = function() {curr.hide(); if(onok) onok();}
	return close;
}


Pophover.prototype.makeTitle = function(text) {
	var popTitle = document.createElement("h3");
	popTitle.textContent = text;
	return popTitle;
}

Pophover.prototype.makeText = function(text) {
	var popText = document.createElement("p");
	popText.textContent = text;
	return popText;
}

Pophover.prototype.show = function() {
	this.pop.style.display = "block";
}

Pophover.prototype.hide = function() {
	this.pop.style.display = "none";
}

Pophover.prototype.showTime = function(ms) {
	this.show();
	var curr = this;
	window.setTimeout(function() {
		curr.hide();
	},ms);
}


