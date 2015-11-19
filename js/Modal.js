function Modal(title,text,onok) {
	var trick = document.createElement("div");
	var modalPophover = new Pophover(trick,title,text,onok);
	modalPophover.show();
	var renderedHeight = modalPophover.pop.offsetHeight;
	var renderedWidth = modalPophover.pop.offsetWidth;
	var windowWidth = parseInt(window.innerWidth);
	var windowHeight = parseInt(window.innerHeight);
	modalPophover.pop.style.top = (windowHeight/2) - (renderedHeight) / 2  + document.body.scrollTop +  'px';
	modalPophover.pop.style.left = (windowWidth - renderedWidth) / 2 + 'px';

	
}