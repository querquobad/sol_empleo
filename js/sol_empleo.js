usuario = {
	email : ''
}

function doAjax(obj,callback) {
	var retval;
	if (obj.url == undefined) {
		obj.url = 'ws.php';
	}
	if (obj.dataType == undefined || obj.jsonp == undefined) {
		obj.dataType = 'json';
		obj.jsonp = false;
	}
	if (obj.method == undefined && obj.type == undefined) { // en JQuery type y method son sinónimos
		obj.method = 'post';
	}
	if (obj.xhrFields == undefined) {
		obj.xhrFields = {withCredentials : true}
	}
	if (obj.data == undefined) {
		console.log('Llamada AJAX sin datos!');
		obj.data = {}
	}
	obj.success = function(data) {
		retval = data
	}
	obj.error = function() {
		retval = false;
	}
	obj.complete = function(jqxhr,text) {
		callback(jqxhr,retval,text);
	}
	$.ajax(obj);
}
