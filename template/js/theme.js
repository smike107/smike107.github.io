var theme = $.cookie('theme');
if (theme == 'on') {
	document.getElementById("style").href = "/template/css/black.css";
}else{
	document.getElementById("style").href = "";
}
$(document).on('click', '#dark', function(e) {
	e.preventDefault();
	document.getElementById("style").href = "/template/css/black.css";
	theme = 'on';
	$.cookie('theme', 'on', { expires: 365 });
});

$(document).on('click', '#light', function(e) {
	e.preventDefault();
	document.getElementById("style").href = "";
	theme = 'off';
	$.cookie('theme', 'off', { expires: 365 });
});
