function multiUploader() {
	this.lastUsed = true;
}

multiUploader.prototype.addUploader = function(caller,isRemovable) {
	with(this) {
		if(!lastUsed) {
			var pop = new Pophover(caller,"Attenzione","L'ultimo uploader non è stato utilizzato");
			pop.show(1000);
			return;
		}
		
		lastUsed = false;
		var newUploader = document.createElement("div");
		newUploader.className = "fileInput fileUploader";
		var label = document.createElement("span");
		//var mask = document.createElement("span");
		//mask.className = "mask";
		label.textContent = "Click per selezionare un file";
		var fileInput = document.createElement("input");
		fileInput.type ="file";
		fileInput.name ="file[]";
		newUploader.appendChild(fileInput);
		newUploader.appendChild(label);
		//newUploader.appendChild(mask);
		newUploader.used = false;
		caller.parentElement.insertBefore(newUploader,caller);
		lastAdded = newUploader;

		newUploader.onclick = function() {
			fileInput.click();

		}

		newUploader.oncontextmenu = function(e) {
			e.preventDefault();
			if(!isRemovable) return;
			caller.parentElement.removeChild(this);
			lastUsed = true;
			return false;
		}

		lastUsed.onselectstart = function(e) {
			e.preventDefault();
			return false;
		}

		fileInput.onchange = function(e) {
			if(newUploader.used == false) lastUsed = true;
			newUploader.used = true;
			label.textContent = e.target.files[0].name + " Size(kb):" + e.target.files[0].size / 1000;
		}
	}

}