//######################################################################
//
//The code for part of Tips is using FSTOOLTIPS.JS   V1.1
//from FUSIONSCRIPTZ   2006
//Thx!
//######################################################################




//########################  START CONFIG  ##############################

var offsetx = 15;
var offsety = 10;
var ie5 = (document.getElementById && document.all);
var ns6 = (document.getElementById && !document.all);
var ua = navigator.userAgent.toLowerCase();
var isapple = (ua.indexOf('applewebkit') != -1 ? 1 : 0);

//########################   END CONFIG   ##############################

function newelement(newid){

    if(document.createElement){
        var el = document.createElement('div');
        el.id = newid;
        with(el.style)
        {
            display = 'none';
            position = 'absolute';
        }
        el.innerHTML = '&nbsp;';
        document.body.appendChild(el);
    }
}

//######################################################################

function getmouseposition(e){

    if(document.getElementById){

        var iebody=(document.compatMode && document.compatMode != 'BackCompat') ?
        		document.documentElement : document.body;
        pagex = (isapple == 1 ? 0:(ie5)?iebody.scrollLeft:window.pageXOffset);
        pagey = (isapple == 1 ? 0:(ie5)?iebody.scrollTop:window.pageYOffset);
        mousex = (ie5)?event.x:(ns6)?clientX = e.clientX:false;
        mousey = (ie5)?event.y:(ns6)?clientY = e.clientY:false;

        var fstooltip = document.getElementById('tooltip');

if ((mousex+offsetx+fstooltip.clientWidth+5) > document.body.clientWidth) {
fstooltip.style.left = ((document.body.scrollLeft+document.body.clientWidth) - (fstooltip.clientWidth*2));
}

else { fstooltip.style.left = (mousex+pagex+offsetx); }


if ((mousey+offsety+fstooltip.clientHeight+5) > document.body.clientHeight) {
fstooltip.style.top = ((document.body.scrollTop+document.body.clientHeight) - (fstooltip.clientHeight*2));
}

else { fstooltip.style.top = (mousey+pagey+offsety); }


    }
}

//######################################################################

function tooltip(tiptitle,tipbold,tipnormal){

    if(!document.getElementById('tooltip')) newelement('tooltip');
    var fstooltip = document.getElementById('tooltip');
    fstooltip.innerHTML = '<table class="fstooltips" cellpadding="2" cellspacing="0"><tr><td class="tipheader"><img src="images/helptip.png" height="14" width="14" align="right">' + tiptitle + '</td></tr><tr><td class="tipcontent"><b>' + tipbold + '</b><br>' + tipnormal + '</td></tr></table>';
    fstooltip.style.display = 'block';
    fstooltip.style.position = 'absolute';
    fstooltip.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(Opacity=70) progid:DXImageTransform.Microsoft.dropshadow(OffX=5, OffY=5, Color=gray, Positive=true)';
    document.onmousemove = getmouseposition;

}

//######################################################################

function exit(){

    document.getElementById('tooltip').style.display = 'none';

}

//######################################################################

//***************************************************************************************
//Show and hide table contents
//***************************************************************************************
function ShowHide(item) {

 obj=document.getElementById(item);
 col=document.getElementById("x" + item);
 inf=document.getElementById("m" + item);

 if (obj.style.display=="none") {
  obj.style.display="block";
  col.innerHTML="<img src='images/minimize.png' alt='minimize' border=0>";
  inf.innerHTML="&nbsp;";
 }
 else {
  obj.style.display="none";
  col.innerHTML="<img src='images/maximize.png' alt='maximize' border=0>";
  inf.innerHTML="Click <img src='images/maximize.png' alt='maximize' border=0> to expand this content";
 }

}

//***************************************************************************************
//show the error message
//***************************************************************************************
function showErrorMessage(error){
    if(!document.getElementById('errormessage'))
        newelement('errormessage');

    var errormessage = document.getElementById("errormessage");

    var iebody=(document.compatMode && document.compatMode != 'BackCompat') ?
        		document.documentElement : document.body;
    pagex = (isapple == 1 ? 0:(ie5)?iebody.scrollLeft:window.pageXOffset);
    pagey = (isapple == 1 ? 0:(ie5)?iebody.scrollTop:window.pageYOffset);

    pox = pagex+ +screen.width/2;
    poy = pagey+screen.height/2;


    errormessage.innerHTML = "";
    errormessage.innerHTML = '<table class="errortips" cellpadding="2" cellspacing="0"><tr><td class="errorheader"><img src="images/close.png" height="14" width="14" align="right" onclick="closeMessage();" style="CURSOR: pointer">'
	+ 'Error:' + '</td></tr><tr><td class="errorcontent"><b>' + ''  + '</b><br>' + error + '<br></td></tr></table>';

    errormessage.style.top = poy-120;
    errormessage.style.left = pox-120;
    errormessage.style.display = "block";
    errormessage.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(Opacity=70) progid:DXImageTransform.Microsoft.dropshadow(OffX=5,OffY=5, Color=gray, Positive=true)';
}

function closeMessage(){
    document.getElementById('errormessage').style.display = 'none';
}

//***************************************************************************************
//Validate the input value
//***************************************************************************************
function chkinput()
{
 var objt = eval(document.FormsGpsphoto.timeoffset);
 var objm = eval(document.FormsGpsphoto.maxtimediff);
 var objgpsopt = document.FormsGpsphoto.gps_opt;  //array
 var objphotosCal_1 = document.FormsGpsphoto.photosCal_1;

 var objphotosCal_2 = document.FormsGpsphoto.photosCal_2;
 var objGPSSelect = document.FormsGpsphoto.GPSSelect;

 var objGPSSelect_3 = document.FormsGpsphoto.GPSSelect_3;

 strRef = "1234567890-*";
 strRefnum = "1234567890";

  if(objm.value == ""){
      showErrorMessage("You have left Maximal Time Difference empty, default value of 120 seconds will be used!");
      objm.value = 120;
      return false;
  }

  if(objt.value == ""){
      showErrorMessage("You have left Time Offset empty, default value of 0 seconds will be used!");
      objt.value = 0;
      return false;
  }

if (objm.value>180) {
    if(confirm("Maximal Time Difference you have inputted is too big, that may cause an inaccurate result. Do you still want to use this value ?")){}
    else{return false;}
    if(objm.type=="text")
        objm.focus();
  }

for (i=0;i<objt.value.length;i++) {
  tempChar= objt.value.substring(i,i+1);
  if (strRef.indexOf(tempChar,0)==-1) {
    showErrorMessage("Please input number in Time Offset!");
   if(objt.type=="text")
    objt.focus();
   return false;
  }
}

for (i=0;i<objm.value.length;i++) {
  tempChar= objm.value.substring(i,i+1);
  if (strRef.indexOf(tempChar,0)==-1) {
    showErrorMessage("Please input number in Maximal Time Difference!");
    if(objm.type=="text")
       objm.focus();
    return false;
  }
}

 //gpsphoto gps_p
 if(objgpsopt[0].checked){
     if(objphotosCal_1.value=="" || objphotosCal_1.value==0){
         showErrorMessage("Please input number more than 0 in Create Upload Operation!");
         objphotosCal_1.value=1;
         return false;
     }

     for (i=0;i<objphotosCal_1.value.length;i++) {
         tempChar= objphotosCal_1.value.substring(i,i+1);
         if (strRefnum.indexOf(tempChar,0)==-1) {
             showErrorMessage("Please input number in Create Upload Operation!");
         if(objphotosCal_1.type=="text"){
             objphotosCal_1.focus();
             objphotosCal_1.value=1;
         }
         return false;
         }
     }

 }


 //photo gpx  gps_gp
 if(objgpsopt[1].checked){
     if(objphotosCal_2.value=="" || objphotosCal_2.value==0){
         showErrorMessage("Please input number more than 0 in Create Upload Operation!");
         objphotosCal_2.value=1;
         return false;
     }

     for (i=0;i<objphotosCal_2.value.length;i++) {
         tempChar= objphotosCal_2.value.substring(i,i+1);
         if (strRefnum.indexOf(tempChar,0)==-1) {
             showErrorMessage("Please input number in Create Upload Operation!");
         if(objphotosCal_2.type=="text"){
             objphotosCal_2.focus();
             objphotosCal_2.value=1;
         }
         return false;
         }
     }

     if(objGPSSelect.value ==""){
         showErrorMessage("Please select GPX file!");
         return false;

     }

 }

 //gpx gps_g
 if(objgpsopt[2].checked){
     if(objGPSSelect_3.value ==""){
         showErrorMessage("Please select GPX file!");
         return false;

     }

 }

  //normal photo gps_pn



}


function show_tbl(pre,n,select_n){
	for(i=1;i<=n;i++){
		var tbl= document.getElementById(pre+i);
		tbl.style.display="none";
        if(i==select_n){
			tbl.style.display="block";
		}
	}
}
