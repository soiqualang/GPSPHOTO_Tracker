// @author       leelight <webmaster@easywms.com>
// @copyright    leelight (c)2006
// @link         http://gpsphoto.easywms.com
// @version      1.0
// @filesource
//
//javascript file for create upload operation dynamically, using Ajax

    var http_request = false;

    function send_request_1(url) {
        http_request = false;

        if (window.XMLHttpRequest) {
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
            }
        } else if (window.ActiveXObject) {
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
        if (!http_request) {
            alert('Cant create XMLHttpRequest object!');
            return false;
        }

        http_request.onreadystatechange = processRequest_1;
        http_request.open('GET', url, true);
        http_request.send(null);

    }

    //处理返回信息
    function processRequest_1() {
        if (http_request.readyState == 1) {
            document.getElementById('divId_1').innerHTML="Creating...";
        }
        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
                //alert(http_request.responseText);
                document.getElementById('divId_1').innerHTML=http_request.responseText;
            } else {
                alert('Error');
            }
        }
    }



    function sndReq_1()
{
        var f=document.FormsGpsphoto;
        var photosCal_1=f.photosCal_1.value;
        if(photosCal_1==""){
            window.alert("Please input the photos number!");
            f.photosCal_1.focus();
            //return false;
        }else{
            send_request_1('photouploadO.class.php?photosCal='+photosCal_1);
        }
}

    function sndReq_2()
{
        var f=document.FormsGpsphoto;
        var photosCal_2=f.photosCal_2.value;
        if(photosCal_2==""){
            window.alert("Please input the photos number!");
            f.photosCal_2.focus();
            //return false;
        }else{
            send_request_2('photouploadO.class.php?photosCal='+photosCal_2);
        }
}

    function send_request_2(url) {
        http_request = false;

        if (window.XMLHttpRequest) {
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
            }
        } else if (window.ActiveXObject) {
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
        if (!http_request) {
            alert('Cant create XMLHttpRequest object!');
            return false;
        }

        http_request.onreadystatechange = processRequest_2;
        http_request.open('GET', url, true);
        http_request.send(null);

    }

    //处理返回信息
    function processRequest_2() {
        if (http_request.readyState == 1) {
            document.getElementById('divId_2').innerHTML="Creating...";
        }
        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
                //alert(http_request.responseText);
                document.getElementById('divId_2').innerHTML=http_request.responseText;
            } else {
                alert('Error');
            }
        }
    }