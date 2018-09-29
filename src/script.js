/* JavaScript function to create color toolbar in Dokuwiki */
/* see http://www.dokuwiki.org/plugin:color for more info */

mark2memorize_icobase = "../../plugins/mark2memorize/images/";

if(window.toolbar != undefined) {
	toolbar[toolbar.length] = {
		"type":  "format",
		"title": "Mark to Memorize",
		"icon":  mark2memorize_icobase + "toolbar_icon.png",
		"open":  "<markmemo>",
		"close": "</markmemo>"
	 };
}

function showAnswer(target) {
	if (target.className == "hide") {
		target.className = "show";
	} else {
		target.className = "hide";
	}
}
