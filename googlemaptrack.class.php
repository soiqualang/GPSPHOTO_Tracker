<?php

/**
 * googlemaptrack.class.php - GPS PHOTO
 *
 * Copyright (C) 2006  leelight  This program is free software; you can
 * redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.  This program is
 * distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *
 * @author       leelight <webmaster@easywms.com>
 * @copyright    leelight (c)2006
 * @link         http://gpsphoto.easywms.com
 * @version      1.0
 * @filesource
 */

/**
 * Class to add GPS and Photo track on Google map, using the coordinate information
 * parsed from GPX file
 *
 * Requires no extension
 */

require("config.php");

class googlemaptrack{



function googlemaptrack($latC, $lonC, $lat, $lon, $photonum ,$photoname, $gps_opt, $gps_op, $gps_op1){


echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">"."\n" ;
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\">"."\n" ;
echo "<head>"."\n" ;
echo "<title>GPSPhoto Goolge Map Track</title>"."\n" ;
echo "<meta name=\"description\" content=\"\" />"."\n" ;
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />"."\n" ;
echo "<link rel=\"stylesheet\" href=\"setup.css\" type=\"text/css\" />"."\n" ;
echo " <style type=\"text/css\">"."\n" ;
echo "    v\:* {"."\n" ;
echo "      behavior:url(#default#VML);"."\n" ;
echo "    }"."\n" ;
echo "    </style>"."\n" ;
echo "<script src=\"http://maps.google.com/maps?file=api&v=2&key=".$GLOBALS['googlekeyeasy']."\" type=\"text/javascript\"></script>"."\n" ;
echo "</head>"."\n"."\n"."\n" ;

echo "<body bgcolor=\"#ffffff\" text=\"#009900\"  leftmargin=\"0\" topmargin=\"0\">"."\n" ;
//===============================Table================================================
echo "<table width=\"99%\"  border=\"0\" cellspacing=\"1\" cellpadding=\"4\">"."\n" ;
echo "                    	<tr>"."\n" ;
                    	if ($gps_opt=="gps_gp") {
echo "                    		<td colspan=\"2\"><h3>GPS and PHOTO Tracker</h3></td>"."\n" ;
                    	}
                    	if ($gps_opt=="gps_g") {
echo "                    		<td colspan=\"2\"><h3>GPX Tracker</h3></td>"."\n" ;
                    	}
                    	if ($gps_opt=="gps_p") {
echo "                    		<td colspan=\"2\"><h3>GPSPHOTO Tracker</h3></td>"."\n" ;
                    	}

echo "                   		</tr>"."\n" ;

echo "                   		<tr>"."\n" ;
echo "                    		<td>"."\n" ;

                    	if ($gps_op1=="wr_kml") {
                    	    echo "<h4>Google Earth KML File</h4>"."\n" ;
                    		echo "<a href=\"upload/gpsphoto.kml\">Download</a><br>"."\n" ;
                    	}
                    	if ($gps_op=="wr_gps") {
                    	    echo "<h4>New Photo with GPS Exif Metadata</h4>"."\n" ;
                            $num_allphoto = max(array_keys($photonum))+1;

						for($l=0;$l<$num_allphoto;$l++){
                        if ($photoname[$l]!=null) {
                        //Remove the non-GPSPhoto
                        if ($lon[$photonum[$l]]!=0 AND $lat[$photonum[$l]]!=0) {
                            echo "<image src=\"images/camera.gif\"><a href=\"".$GLOBALS['Photo_dir'].$GLOBALS['Photo_prefix'].$photoname[$l]."\">".$GLOBALS['Photo_prefix'].$photoname[$l]."</a>"."   " ;
                            }
                            }
                            }
                    	}

echo "							</td>"."\n" ;
echo "                    		<td>"."\n" ;
echo "							</td>"."\n" ;
echo "                   		</tr>"."\n" ;
echo "</table>"."\n" ;


//===========================googlemap======================================
    echo "<div id=\"map\" style=\"width: 640px; height: 480px\" align=\"center\"></div>"."\n"."\n" ;

    echo "<script type=\"text/javascript\">"."\n" ;
	echo "//<![CDATA["."\n"."\n";

    echo "        // check for compatibility"."\n";
	echo "		if (GBrowserIsCompatible()) {"."\n"."\n" ;

	echo "			// call the info window opener for the given index"."\n" ;
	echo "			function makeOpenerCaller(i) {"."\n" ;
	echo "				return function() { showMarkerInfo(i); };"."\n" ;
	echo "			}"."\n"."\n" ;

	echo "			// open an info window"."\n" ;
	echo "			function showMarkerInfo(i) {"."\n" ;
	echo "				markers[i].openInfoWindowHtml(infoHtmls[i]);"."\n" ;
	echo "			}"."\n"."\n" ;

	echo "			// create the map"."\n" ;
	echo "			var map = new GMap(document.getElementById(\"map\"));"."\n" ;
	echo "			map.addControl(new GLargeMapControl());"."\n" ;
	echo "			map.addControl(new GMapTypeControl());"."\n" ;
	echo "			map.addControl(new GScaleControl());"."\n" ;
	echo "			map.centerAndZoom(new GLatLng($latC, $lonC), 3);"."\n" ;
	echo "			if (window.attachEvent) {"."\n" ;
	echo "				window.attachEvent(\"onresize\", function() {this.map.onResize()} );"."\n" ;
	echo "			} else {"."\n" ;
	echo "				window.addEventListener(\"resize\", function() {this.map.onResize()} , false);"."\n" ;
	echo "				}"."\n"."\n" ;

	echo "			// add the markers"."\n" ;
	echo "			var request = GXmlHttp.create();"."\n" ;
	echo "			request.open(\"GET\", \"upload/photo.xml\", true);"."\n" ;
	echo "			request.onreadystatechange = function() {"."\n" ;
	echo "				if (request.readyState == 4) {"."\n" ;
	echo "					var xmlDoc = request.responseXML;"."\n" ;
	echo "					var markerElements = xmlDoc.getElementsByTagName(\"marker\");"."\n" ;
	echo "					markerElementsLen = markerElements.length;"."\n" ;
	echo "					photos = new Array(markerElements.length);"."\n" ;
	echo "					markers = new Array(markerElements.length);"."\n" ;
	echo "					infoHtmls = new Array(markerElements.length);"."\n" ;
	echo "					for (var i = 0; i < markerElements.length; ++i) {"."\n" ;
	echo "						photos[i] = new GLatLng(parseFloat(markerElements[i].getAttribute(\"lat\")), parseFloat(markerElements[i].getAttribute(\"lng\")));"."\n" ;
	echo "						markers[i] = new GMarker(photos[i]);"."\n" ;
	echo "						infoHtmls[i] = markerElements[i].getAttribute(\"html\")"."\n" ;
	echo "						map.addOverlay(markers[i]);"."\n" ;
	echo "						GEvent.addListener(markers[i],'click',makeOpenerCaller(i));"."\n" ;
	echo "					}"."\n" ;
	echo "				}"."\n" ;
	echo "			}"."\n" ;
	echo "			request.send(null);"."\n"."\n" ;


    echo "            // add a polyline overlay"."\n" ;
	echo "			var points = new Array();"."\n"."\n" ;

     if ($gps_opt=="gps_gp" OR $gps_opt=="gps_g") {
     for($j= 1;$j<=count($lon);$j++){
          echo "			points.push(new GLatLng($lat[$j], $lon[$j]));"."\n" ;
		    }
     }

    if ($gps_opt=="gps_p") {
          $num_allphoto = max(array_keys($lon))+1;
          for($j= 0;$j<$num_allphoto;$j++){
            //Remove the non-GPSPhoto
            if ($lat[$j]!=0 AND $lon[$j]!=0) {
            	echo "			points.push(new GLatLng($lat[$j], $lon[$j]));"."\n" ;
				  }

		    }
    }

	echo "			map.addOverlay(new GPolyline(points, \"#FF0000\", 2, .75));"."\n"."\n" ;

	echo "		}"."\n" ;
	echo "		else {"."\n" ;
	echo "			document.getElementById(\"quicklinks\").innerHTML = \"Your web browser is not compatible with this website.\""."\n" ;
	echo "		}"."\n"."\n" ;


    echo "//]]>"."\n" ;
    echo "</script>"."\n"."\n"."\n" ;

//===========================googlemap======================================




?>

</body>
</html>

<?

}

}

//$lon = array(9.062024,9.062026);
//$lat = array(46.767872,46.767876);
//$googlemaptrack = new googlemaptrack(9.062026,46.767876, $lon ,$lat );

?>