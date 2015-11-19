function Modal(title,text,onok) {
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
	var renderedHeight = modalPophover.pop.offsetHeight;
	var renderedWidth = modalPophover.pop.offsetWidth;
	var windowWidth = parseInt(window.innerWidth);
	var windowHeight = parseInt(window.innerHeight);
	modalPophover.pop.style.top = (windowHeight/2) - (renderedHeight) / 2  + document.body.scrollTop +  'px';
	modalPophover.pop.style.left = (windowWidth - renderedWidth) / 2 + 'px';
	modalPophover.closeButton.onclick = function() { 
		document.body.removeChild(darken); 
		modalPophover.hide(); 
		if(onok) onok();
	}
}