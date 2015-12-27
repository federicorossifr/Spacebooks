var STAR_ON = "./img/star_on.png";
var STAR_OFF = "./img/star_off.png";

function Reviewer(container,max,selected,callback) {
	this.container = document.getElementById(container);
	this.selectedValue = selected;
	this.stars = new Array();
	this.starNumber = max;
	this.callback = callback;
	this.init(max,selected);
}

Reviewer.prototype.init = function(max,selected) {
	with(this) {
		for(var i = 0; i < max; ++i) {
			var star = document.createElement("img");
			star.src = STAR_OFF;
			star.width = "30";

			star.id = i;
			star.alt = "nostar";
			star.onmouseenter = function() { highlight(this); }
			star.onclick = function() { select(this); }
			container.appendChild(star);
			stars.push(star);
		}

		if(selected != 0) {
			highlight(this.stars[selected-1]);
			select(this.stars[selected-1]);
		} 
		
		container.onmouseleave = function() { blur(); }
	}
}


Reviewer.prototype.highlight = function(star) {
	with(this) {
		threshold = Number(star.getAttribute("id"));
		for(var i = 0; i <= threshold; ++i) {
			stars[i].src = STAR_ON;
		}

		for(var i =threshold+1; i < stars.length; ++i) {
			stars[i].src = STAR_OFF;
		}
	}
};

Reviewer.prototype.blur = function() {
	with(this) {
		for(var i = 0; i < stars.length; ++i) {
			if(stars[i].getAttribute("data-stella") == "si") stars[i].src = STAR_ON;
			else stars[i].src = STAR_OFF;
		}
	}
};


Reviewer.prototype.select = function(star) {
	with(this) {
		for(var i = 0; i <= Number(star.id); ++i) {
			stars[i].setAttribute("data-stella","si");
		}

		for(var i = Number(star.id) + 1; i < stars.length; ++i) {
			stars[i].setAttribute("data-stella","no")
		}

		selectedValue = Number(star.id);

		if(callback)
			callback(selectedValue); 
	}
};