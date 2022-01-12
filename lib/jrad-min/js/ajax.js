// AJAX Object 
// Ex. const ajax = new Ajax();

function Ajax ()
{
	var xhttp = window.XMLHttpRequest? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	// METHOD POST
	this.post = function (url, query, callback) {	
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
				callback(this.responseText);
		};
		xhttp.open('POST',url,true);
		xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhttp.send(query);
	}
	
	// METHOD GET
	this.get = function (url, query, callback) {
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
				callback(this.responseText);
		};
		var request = url+'?'+query;
		xhttp.open('GET',request,true);
		xhttp.send();
	}
	
	// METHOD REQUEST
	this.request = function (url, callback) {
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
				callback(this.responseText);
		};
		xhttp.open('GET',url,true);
		xhttp.send();
	}
}