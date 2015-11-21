function center(obj) {
	var renderedHeight = obj.offsetHeight;
	var renderedWidth = obj.offsetWidth;
	var windowWidth = parseInt(window.innerWidth);
	var windowHeight = parseInt(window.innerHeight);
	obj.style.top = (windowHeight/2) - (renderedHeight) / 2  + document.body.scrollTop +  'px';
	obj.style.left = (windowWidth - renderedWidth) / 2 + 'px';
}

function Modal(title,text,onok,canIgnore) {
	var darken = document.createElement("div");
	darken.style.position = "absolute";
	darken.style.left = "0";
	darken.style.top = "0";
	darken.style.height = "calc(100% + " + document.body.scrollTop + "px)"; 
	darken.style.width = "100%";
	darken.style.backgroundColor = "black";
	darken.style.opacity = "0.66";
	document.body.appendChild(darken);

	var modalPophover = new Pophover(darken,title,text,onok);
	modalPophover.show();
	center(modalPophover.pop);
	/*var renderedHeight = modalPophover.pop.offsetHeight;
	var renderedWidth = modalPophover.pop.offsetWidth;
	var windowWidth = parseInt(window.innerWidth);
	var windowHeight = parseInt(window.innerHeight);
	modalPophover.pop.style.top = (windowHeight/2) - (renderedHeight) / 2  + document.body.scrollTop +  'px';
	modalPophover.pop.style.left = (windowWidth - renderedWidth) / 2 + 'px';*/

	darken.onclick = function() {
		if(!canIgnore) return false;
		document.body.removeChild(this);
		modalPophover.hide();
	}

	modalPophover.closeButton.onclick = function() { 
		document.body.removeChild(darken); 
		modalPophover.hide(); 
		if(onok) onok();
	}

	return modalPophover;
}

function PictureModal(title,image,onok) {
	var modal = Modal(title,"",onok,true);
	modal.pop.insertBefore(image,modal.closeButton);
	center(modal.pop);
}