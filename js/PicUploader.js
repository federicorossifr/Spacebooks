
var DEFAULT_PIC = "./img/file-esplora.png";

function PicUploader(wrapper) {
	this.iWrapper = document.getElementById(wrapper);
	this.iFile = this.iWrapper.querySelector("input[type=file]");
	this.iFile.value = "";
	this.iProgress = this.iWrapper.querySelector("progress");
	this.iPreview = this.iWrapper.querySelector("img");
	this.iPreview.src = DEFAULT_PIC;
	this.ifReader = new FileReader();

	with(this) {
		iProgress.style.display = "none";
		iPreview.style.display = "none";
		iWrapper.onclick = function() {iFile.click();}
		iFile.onchange = function(event) {readPic(event.target.files[0]);}

		ifReader.onprogress = function(event) {iProgress.value = event.loaded / this.fileSize * 100; }
		ifReader.onload = function(event) { loaded(event);}
	}
}

PicUploader.prototype.readPic = function(file) {
	this.ifReader.readAsDataURL(file);
	this.ifReader.fileSize = file.size;
	this.iProgress.style.display = "block";
}

PicUploader.prototype.loaded = function(event) {
	console.log(event);
	this.iPreview.src = event.target.result;
	this.iPreview.style.display = "block";
	this.iProgress.style.display = "none";
}
