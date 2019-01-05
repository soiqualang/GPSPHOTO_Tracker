//Pulldown DIV start
document.write("<div id='menuDiv' style='Z-INDEX: 200; VISIBILITY: hidden; WIDTH: 1px; POSITION: absolute; HEIGHT: 1px; BACKGROUND-COLOR:#FFFFFF;'></div>");

 var h;
 var w;
 var l;
 var t;
 var topMar = 1;
 var leftMar = -5;
 var space = 20;
 var isvisible;
 var MENU_SHADOW_COLOR='#999999';
 //var MENU_SHADOW_COLOR='#ffffcc';
 var global = window.document
 global.fo_currentMenu = null
 global.fo_shadows = new Array

function TxBBS_HideMenu()
{
 	var mX;
 	var mY;
 	var vDiv;
 	var mDiv;
	if (isvisible == true)
	{
		vDiv = document.all("menuDiv");
		mX = window.event.clientX + document.body.scrollLeft;
		mY = window.event.clientY + document.body.scrollTop;
		if ((mX < parseInt(vDiv.style.left)) || (mX > parseInt(vDiv.style.left)+vDiv.offsetWidth) || (mY < parseInt(vDiv.style.top)-h) || (mY > parseInt(vDiv.style.top)+vDiv.offsetHeight))
		{
			vDiv.style.visibility = "hidden";
			isvisible = false;
		}
	}
}
function TxBBS_ShowMenu(vHtmls,tWidth) //(vForumNav,410)
{
	vSrc = window.event.srcElement;
	vMnuCode = "<table id='submenu' cellspacing=1 cellpadding=3 style='width:"+tWidth+"' style='background-color: #3366cc;' onmouseout='TxBBS_HideMenu()'><tr height=23><td nowrap style='background-color: #FFFFFF;padding-left:6px;padding-right:4px;' valign=top >" + vHtmls + "</td></tr></table>";

	h = vSrc.offsetHeight;
	w = vSrc.offsetWidth;
	l = vSrc.offsetLeft + leftMar+ (screen.width)*0.15 +5;
	t = vSrc.offsetTop + topMar + h + space-2;
	vParent = vSrc.offsetParent;
	while (vParent.tagName.toUpperCase() != "BODY")
	{
		l += vParent.offsetLeft;
		t += vParent.offsetTop;
		vParent = vParent.offsetParent;
	}
	menuDiv.innerHTML = vMnuCode;
	menuDiv.style.top = t;
	menuDiv.style.left = l;
	menuDiv.style.visibility = "visible";
	isvisible = true;
    makeRectangularDropShadow(submenu, MENU_SHADOW_COLOR, 4)
}
function makeRectangularDropShadow(el, color, size)
{
	var i;
	for (i=size; i>0; i--)
	{
		var rect = document.createElement('div');
		var rs = rect.style
		rs.position = 'absolute';
		rs.left = (el.style.posLeft + i) + 'px';
		rs.top = (el.style.posTop + i) + 'px';
		rs.width = el.offsetWidth + 'px';
		rs.height = el.offsetHeight + 'px';
		rs.zIndex = el.style.zIndex - i;
		rs.backgroundColor = color;
		var opacity = 1 - i / (i + 1);
		rs.filter = 'alpha(opacity=' + (100 * opacity) + ')';
		el.insertAdjacentElement('afterEnd', rect);
		global.fo_shadows[global.fo_shadows.length] = rect;
	}
}

document.body.attachEvent("onmouseout",TxBBS_HideMenu);

vTimeD = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:1px #CDB38B solid;font-size:12px;border-collapse:collapse;\"><tr class=\"intro\"><td class=\"intro\"><p class=\"intro\">Description: Maximal time difference given in seconds between the image timestamp and the timestamps in the gpx file. Image that have the smallest time differences will get the corresponding coordinate. <br>If you omit this parameter, a default of 120 seconds will be used.</p></td></tr></table>";

vTimeO = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:1px #CDB38B solid;font-size:12px;border-collapse:collapse;\"><tr class=\"intro\"><td class=\"intro\"><p class=\"intro\">Description: Timeoffset given in seconds between the camera and the gps device.This can be used f.e. time in UTC time and local time, wrong time set in camera.A value of 3600 means one hour time difference where the camera is one hour behind in time.<br>A positive value means that the camera is behind in time, a negative value means that the camera is ahead in time.<br>If you omit this parameter, a default of 0 seconds will be used.</p></td></tr></table>";

vExifW = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:1px #CDB38B solid;font-size:12px;border-collapse:collapse;\"><tr class=\"intro\"><td class=\"intro\"><p class=\"intro\">You can download the new photos with GPS metadata, all original Exif metadata will be kept.</td></tr></table>";

vKml = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:1px #CDB38B solid;font-size:12px;border-collapse:collapse;\"><tr class=\"intro\"><td class=\"intro\"><p class=\"intro\">You can use GoogleEarth to open this KML file.</td></tr></table>";

vTrack = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:1px #CDB38B solid;font-size:12px;border-collapse:collapse;\"><tr class=\"intro\"><td class=\"intro\"><p class=\"intro\">Track Result Example :<br><br><image src=\"images/gpsphotoi.gif\"  border=\"0\" ></td></tr></table>";
