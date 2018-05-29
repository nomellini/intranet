function maximizewindow() {
	if (parseInt(navigator.appVersion)>3) {
		if (navigator.appName=="Netscape") {
			if (top.screenX>0 || top.screenY>0)
				top.moveTo(0,0);
			if (top.outerWidth < screen.availWidth)
				top.outerWidth=screen.availWidth;
			if (top.outerHeight < screen.availHeight)
				top.outerHeight=screen.availHeight;
		} else {
			top.moveTo(-4,-4);
			top.resizeTo(screen.availWidth+8,screen.availHeight+8);
		}
	}
}
