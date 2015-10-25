function AsyncReq(url,callback) {

	this.url = url;
	this.client = new XMLHttpRequest();
	this.client.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			callback(this.responseText);
		}
	}
}


AsyncReq.prototype.GET = function(params) {
	var query = this.url + "?";
	for(var i = 0; i < params.length; ++i) {
		query+= params[i].id + "=" + params[i].value;

		if(i != params.length - 1) {
			query+="&";
		}
	}
	this.client.open("GET",query,true);
	this.client.send();
}
