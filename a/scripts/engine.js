// Get base url
url = document.location.href;
xend = url.lastIndexOf("/") + 1;
var base_url = url.substring(0, xend);

var ajax_get_error = false;

function ajax_do (url) {
	// Does URL begin with http?
	if (url.substring(0, 4) != 'http') {
		url = base_url + url;
	}

	// Create new JS element
	var jsel = document.createElement('SCRIPT');
	jsel.type = 'text/javascript';
	jsel.src = url;

	// Append JS element (therefore executing the 'AJAX' call)	
    document.body.appendChild (jsel);

	return true;
}

function ajax_get (url, el) {
	// Has element been passed as object or id-string?
	if (typeof(el) == 'string') {
		el = document.getElementById(el);
	}

	// Valid el?
	if (el == null) { return false; }

	// Does URL begin with http?
	if (url.substring(0, 4) != 'http') {
		url = base_url + url;
	}

	// Create getfile URL
	getfile_url = base_url + 'pegaarquivo.php?url=' + escape(url) + '&el=' + escape(el.id);
	// Do Ajax
	ajax_do (getfile_url);

	return true;
}

