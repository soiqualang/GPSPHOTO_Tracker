<?php


/**
 * gpsphototrack.class.php - GPS PHOTO
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
 * Class for synchronize the timestamp between GPX file and photos
 * Find the corresponding coordinates for the photo
 *
 *
 * Requires  exifreader.class.php, writephotoxml.class.php, googlemaptrack.class.php extension
 */


require("exifreader.class.php");
require("writephotoxml.class.php");
require("googlemaptrack.class.php");


class gpsphototrack {

public $S_Photo_Lon = array();
public $S_Photo_Lat = array();
public $S_Photo_Ele = array();
public $S_arr_exif = array();

public $S_GPS_LonC ;
public $S_GPS_LatC ;

public $S_Photo_Time;
public $S_Photo_Time_D;
public $S_Photo_Time_H;

public $S_Number;
public $S_Number_f;
public $S_Photoname;

function gpsphototrack($Camera_file, $photo_nullnr){

    //echo $googlekeygeo."ha";

$this->Camera_exifread($Camera_file);
//$this->Camera_exifread($Camera_file, $photo_nullnr);


//print_r($this->S_arr_exif);
$countphotoall = count($Camera_file);


for($k=0;$k<$countphotoall;$k++){
if (substr($Camera_file[$k], -4)==".jpg" OR substr($Camera_file[$k], -4)==".tif") {

$this->S_Photoname[$k] = $this->S_arr_exif[$k][FileName];
//echo $this->S_Photoname[$k];
//2002:07:13 15:58:28
$this->S_Photo_Time[$k] = explode(" ", trim($this->S_arr_exif[$k][DateTimeOriginal]));
$this->S_Photo_Time_D[$k] = $this->S_Photo_Time[$k][0];
$this->S_Photo_Time_Dall[$k] = split(':',$this->S_Photo_Time_D[$k]);
$this->S_Photo_Time_Dy[$k] = $this->S_Photo_Time_Dall[$k][0];
$this->S_Photo_Time_Dm[$k] = $this->S_Photo_Time_Dall[$k][1];
$this->S_Photo_Time_Dd[$k] = $this->S_Photo_Time_Dall[$k][2];

$this->S_Photo_Time_H[$k] = $this->S_Photo_Time[$k][1];
$this->S_Photo_Time_Hall[$k] = split(':',$this->S_Photo_Time_H[$k]);
$this->S_Photo_Time_Hh[$k] = $this->S_Photo_Time_Hall[$k][0];
$this->S_Photo_Time_Hm[$k] = $this->S_Photo_Time_Hall[$k][1];
$this->S_Photo_Time_Hs[$k] = $this->S_Photo_Time_Hall[$k][2];

$this->S_Photo_Time_Sec[$k] = mktime($this->S_Photo_Time_Hh[$k], $this->S_Photo_Time_Hm[$k], $this->S_Photo_Time_Hs[$k], $this->S_Photo_Time_Dm[$k], $this->S_Photo_Time_Dd[$k], $this->S_Photo_Time_Dy[$k]);

$this->S_Photo_Lon[$k] = $this->S_arr_exif[$k][GPSLongitude];
$this->S_Photo_Lat[$k] = $this->S_arr_exif[$k][GPSLatitude];
$this->S_Photo_Ele[$k] = $this->S_arr_exif[$k][GPSAltitude];


//$this->S_Number[$k]=1;
//if (isset($this->S_Number[$k])) {

    echo "Longitude : ".$this->S_Photo_Lon[$k]."<br>";
    echo "Latitude : ".$this->S_Photo_Lat[$k]."<br>";
    echo "Altitude : ".$this->S_Photo_Ele[$k]."<br>";
    $timestamp[$k] = $this->S_Photo_Time[$k][0]." ".$this->S_Photo_Time[$k][1];

	//}
}
}//for!!!!!!!!!!


//print_r($this->S_Number_f) ;
//print_r($this->S_Photoname) ;

	//$writephotoxml = new writephotoxml($this->S_Photo_Lat, $this->S_Photo_Lon, $this->S_Number_f, $this->S_Photoname, $timestamp);
    //$googlemaptrack = new googlemaptrack($this->S_Photo_LatC, $this->S_Photo_LonC, $this->S_Photo_Lat ,$this->S_Photo_Lon );
}


function Camera_exifread($file){

$imgname = $file;
$exif = new exifreader($imgname);

$this->S_arr_exif = $exif->new_img_info;
}


}


//$Camera_file = Array( "upload/gg_gps.jpg", "C:/Apache/Apache2/htdocs/test/GPSPhoto/upload/", "C:/Apache/Apache2/htdocs/test/GPSPhoto/upload/s_gps.jpg", "C:/Apache/Apache2/htdocs/test/GPSPhoto/upload/" );
//$gpsphototrack = new gpsphototrack($Camera_file);

?>