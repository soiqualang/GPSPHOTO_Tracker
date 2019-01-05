<?php


/**
 * synchronize.class.php - GPS PHOTO
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
 * Requires GPX2ARRAY.class.php, exifreader.class.php, exifwriter.class.php,writephotoxml.class.php,
 * writekml.class.php and googlemaptrack.class.php config.class extension
 */


require("config.php");
require("GPX2ARRAY.class.php");
require("exifreader.class.php");
require("exifwriter.class.php");
require("writephotoxml.class.php");
require("googlemaptrack.class.php");
require("writekml.class.php");


class synchronize {

//the maximal allowed time difference in seconds between the image exif "DateTimeOriginal" timestamp
//and the timestamps in the gpx file. Images that have larger time differences than the given maximal
//value don't get a coordinate; if you omit this parameter, a default of 120 seconds will be used.
//Note: if more than one gps track points fall into this time frame for a given photo,
//the trackpoint with the smallest time difference will be selected
//$S_Photo_Time_H= $S_GPS_Time_H +/- $S_maxtimediff;
public $S_maxtimediff ;


//an optional parameter to describe a timeoffset given in seconds between the camera and the gps device.
//This can be used f.e. if the gps device records a time in UTC time and the camera records a local time.
//Another purpose might be a wrong time in the camera where the user later still knows the time-offset.
//A value of 3600 means one hour time-difference where the camera is one hour behind in time.
//A positive value means that the camera is behind in time, a negative value means that the camera is ahead in time.
//$S_Photo_Time_D= $S_GPS_Time_D + $S_timeoffset;
public $S_timeoffset ;



public $S_GPS_Lon = array();
public $S_GPS_Lat = array();
public $S_GPS_Ele = array();
public $S_Photo_Lon = array();
public $S_Photo_Lat = array();
public $S_Photo_Ele = array();

public $S_arr_exif = array();

public $S_GPS_LonC ;
public $S_GPS_LatC ;
public $S_Photo_LonC ;
public $S_Photo_LatC ;

public $S_GPS_Time = array();
public $S_GPS_Time_D;
public $S_GPS_Time_Dy;
public $S_GPS_Time_Dm;
public $S_GPS_Time_Dd;

public $S_GPS_Time_H;
public $S_GPS_Time_Hh;
public $S_GPS_Time_Hm;
public $S_GPS_Time_Hs;

public $S_Photo_Time;
public $S_Photo_Time_D;
public $S_Photo_Time_H;

public $S_GPS_Time_Sec;
public $S_Photo_Time_Sec;
public $S_Number;
public $S_Number_f;
public $S_Photoname;

function synchronize($GPS_file, $Camera_file, $gps_opt, $gps_op, $gps_op1,$photo_nullnr){

//echo $googlekeygeo."ha";
$this->S_maxtimediff = maxtimediff;
$this->S_timeoffset = timeoffset;

if ($gps_opt=="gps_gp" OR $gps_opt=="gps_g") {
$this->GPS_parse($GPS_file);
}
$this->Camera_exifread($Camera_file);
//$this->Camera_exifread($Camera_file, $photo_nullnr);

$num_arr_gpstime = count($this->S_GPS_Time);
//2005-09-04T18:35:40Z
for($i= 1;$i<$num_arr_gpstime;$i++){

$this->S_GPS_Time[$i]= split('[T|Z]',trim($this->S_GPS_Time[$i]));

$this->S_GPS_Time_D[$i] = $this->S_GPS_Time[$i][0];
$this->S_GPS_Time_Dall[$i] = split('-',$this->S_GPS_Time_D[$i]);
$this->S_GPS_Time_Dy[$i] = $this->S_GPS_Time_Dall[$i][0];
$this->S_GPS_Time_Dm[$i] = $this->S_GPS_Time_Dall[$i][1];
$this->S_GPS_Time_Dd[$i] = $this->S_GPS_Time_Dall[$i][2];

$this->S_GPS_Time_H[$i] = $this->S_GPS_Time[$i][1];
$this->S_GPS_Time_Hall[$i] = split(':',$this->S_GPS_Time_H[$i]);
$this->S_GPS_Time_Hh[$i] = $this->S_GPS_Time_Hall[$i][0];
$this->S_GPS_Time_Hm[$i] = $this->S_GPS_Time_Hall[$i][1];
$this->S_GPS_Time_Hs[$i] = $this->S_GPS_Time_Hall[$i][2];

$this->S_GPS_Time_Sec[$i] = mktime($this->S_GPS_Time_Hh[$i], $this->S_GPS_Time_Hm[$i], $this->S_GPS_Time_Hs[$i], $this->S_GPS_Time_Dm[$i], $this->S_GPS_Time_Dd[$i], $this->S_GPS_Time_Dy[$i]);

}
//print_r($this->S_GPS_Time_Sec);

//print_r($this->S_arr_exif);
$countphotoall = count($Camera_file);
for($k=0;$k<$countphotoall;$k++){
if (substr($Camera_file[$k], -4)==".jpg" OR substr($Camera_file[$k], -4)==".tif") {
//if ($Camera_file[$k]!="") {

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
$this->S_Photo_Time_Sec_M[$k] = $this->S_Photo_Time_Sec[$k] - $this->S_timeoffset;
//echo $this->S_Photo_Time_Sec_M[$k]." ";


//==============================================================================================================
/*begin to synchronize or track GPX file
*/
//==============================================================================================================
if ($gps_opt=="gps_gp" OR $gps_opt=="gps_g") {
for($j= 1;$j<$num_arr_gpstime;$j++){
$Timeoffset[$k][$j] = abs($this->S_Photo_Time_Sec_M[$k] - $this->S_GPS_Time_Sec[$j]);

if ($Timeoffset[$k][$j]<=$this->S_maxtimediff) {
    $this->S_Number[$k][$j] = $j;
	}
	else {
	}
}
// If there are more than one points are in the timeoffset, choose the smallest time difference
if (count($this->S_Number[$k])>1) {
     //asort($Timeoffset);
     foreach ($Timeoffset[$k] as $key => $val) {
      if ($val==min($Timeoffset[$k])) {
          $this->S_Number_f[$k] = $key;
		    }
     }
	}
	else{
@        $this->S_Number_f[$k] = array_sum($this->S_Number[$k]);
	}

//$this->S_Number[$k]=1;
if (isset($this->S_Number[$k])) {
    //echo "This Photo's position is recorded as Nr.".$this->S_Number_f." point in GPS file"."<br>";
    //echo "Longitude : ".$this->S_GPS_Lon[$this->S_Number_f]."<br>";
    //echo "Latitude : ".$this->S_GPS_Lat[$this->S_Number_f]."<br>";
    //echo "Altitude : ".$this->S_GPS_Ele[$this->S_Number_f]."<br>";
    $timestamp[$k] = $this->S_GPS_Time[$this->S_Number_f[$k]][0]." ".$this->S_GPS_Time[$this->S_Number_f[$k]][1];
    //echo "GPS TimeStamp : ".$this->S_GPS_Time[$this->S_Number_f][0]." ".$this->S_GPS_Time[$this->S_Number_f][1]."<br>";
	}
else{
echo "Error: No corresponding position for image Nr.".number_format($k+1)." was found!"."<br>";
}

}//if ($gps_opt=="gps_gp" OR $gps_opt=="gps_g")
//==============================================================================================================

//==============================================================================================================
/*begin to track GPS Photos
*/
//==============================================================================================================
if ($gps_opt=="gps_p") {

    $this->S_Photo_Lon[$k] = $this->S_arr_exif[$k][GPSLongitude];
    $this->S_Photo_Lat[$k] = $this->S_arr_exif[$k][GPSLatitude];
    $this->S_Photo_Ele[$k] = $this->S_arr_exif[$k][GPSAltitude];
    $this->S_Photo_LonRef[$k] = $this->S_arr_exif[$k][GPSLongitudeRef];
    $this->S_Photo_LatRef[$k] = $this->S_arr_exif[$k][GPSLatitudeRef];

    if ($this->S_Photo_LonRef[$k]=="West latitude") {
    $this->S_Photo_Lon[$k] = 0 - $this->degree2num($this->S_Photo_Lon[$k]);
		    }
	elseif ($this->S_Photo_LonRef[$k]=="East latitude") {
    $this->S_Photo_Lon[$k] = $this->degree2num($this->S_Photo_Lon[$k]);
		    }
    if ($this->S_Photo_LatRef[$k]=="North latitude") {
    $this->S_Photo_Lat[$k] = $this->degree2num($this->S_Photo_Lat[$k]);
		    }
	elseif ($this->S_Photo_LatRef[$k]=="South latitude") {
    $this->S_Photo_Lat[$k] = 0 - $this->degree2num($this->S_Photo_Lat[$k]);
		    }

    $this->S_Photo_Ele[$k] = $this->degree2num($this->S_Photo_Ele[$k]);

    //echo "Longitude : ".$this->S_Photo_Lon[$k]."<br>";
    //echo "Latitude : ".$this->S_Photo_Lat[$k]."<br>";
    //echo "Altitude : ".$this->S_Photo_Ele[$k]."<br>";
    $timestamp[$k] = $this->S_Photo_Time[$k][0]." ".$this->S_Photo_Time[$k][1];
    $this->S_Number_f[$k]= $k;
}




}
}//for!!!!!!!!!!
//print_r($this->S_Number_f) ;
//print_r($this->S_Photoname) ;

if ($gps_opt=="gps_gp") {
	$writephotoxml = new writephotoxml($this->S_GPS_Lat, $this->S_GPS_Lon, $this->S_Number_f, $this->S_Photoname, $timestamp, $gps_opt);
    if ($gps_op1=="wr_kml") {
	$writekml = new writekml($this->S_GPS_Lat, $this->S_GPS_Lon, $this->S_GPS_Ele, $this->S_Number_f, $this->S_Photoname, $timestamp, $gps_opt);
    }
	if ($gps_op=="wr_gps") {
	$exifwriter = new exifwriter($this->S_GPS_Lat, $this->S_GPS_Lon, $this->S_GPS_Ele, $this->S_Number_f ,$this->S_Photoname, $timestamp);
    }
    sleep(5);//wait for xml file writing
    $googlemaptrack = new googlemaptrack($this->S_GPS_LatC, $this->S_GPS_LonC, $this->S_GPS_Lat ,$this->S_GPS_Lon, $this->S_Number_f, $this->S_Photoname,$gps_opt, $gps_op, $gps_op1 );
}

if ($gps_opt=="gps_g") {
    if ($gps_op1=="wr_kml") {
	$writekml = new writekml($this->S_GPS_Lat, $this->S_GPS_Lon, $this->S_GPS_Ele,  $this->S_Number_f, $this->S_Photoname, $timestamp, $gps_opt);
    }
    $googlemaptrack = new googlemaptrack($this->S_GPS_LatC, $this->S_GPS_LonC, $this->S_GPS_Lat ,$this->S_GPS_Lon, $this->S_Number_f, $this->S_Photoname,$gps_opt,$gps_op, $gps_op1 );
}

if ($gps_opt=="gps_p") {
    $this->S_Photo_LatC = (max($this->S_Photo_Lat) + min($this->S_Photo_Lat))/2;
    $this->S_Photo_LonC = (max($this->S_Photo_Lon) + min($this->S_Photo_Lon))/2;
#print_r($this->S_Number_f);
#print_r($this->S_Photoname);
#print_r($this->S_Photo_Lat);
	$writephotoxml = new writephotoxml($this->S_Photo_Lat, $this->S_Photo_Lon, $this->S_Number_f, $this->S_Photoname, $timestamp, $gps_opt);
    if ($gps_op1=="wr_kml") {
	$writekml = new writekml($this->S_GPS_Lat, $this->S_GPS_Lon, $this->S_GPS_Ele, $this->S_Number_f, $this->S_Photoname, $timestamp, $gps_opt);
    }
	sleep(5);
	$googlemaptrack = new googlemaptrack($this->S_Photo_LatC, $this->S_Photo_LonC, $this->S_Photo_Lat ,$this->S_Photo_Lon, $this->S_Number_f, $this->S_Photoname,$gps_opt,$gps_op, $gps_op1 );
}




}

function GPS_parse($file){

$xmlparse = new GPXToArray();
$gpx_filename = $file;
$xml_file = @fopen($gpx_filename,'r') or exit();
while (($data = fread($xml_file,4194304))) {
  $xmlparse->parse($data);
//print_r($xmlparse->arr_trkpt_lat);
//print_r($xmlparse->arr_trkpt_lon);
//print_r($xmlparse->arr_trkpt_ele);
//print_r($xmlparse->arr_trkpt_time); //from 1 to n
$this->S_GPS_Lat = $xmlparse->arr_trkpt_lat;
$this->S_GPS_Lon = $xmlparse->arr_trkpt_lon;
$this->S_GPS_Ele = $xmlparse->arr_trkpt_ele;
$this->S_GPS_Time = $xmlparse->arr_trkpt_time;

$this->S_GPS_LatC = $xmlparse->arr_latC;
$this->S_GPS_LonC = $xmlparse->arr_lonC;
//if there is no BOUNDS Tag in Gpx file, select the min&max of lat&lon
if($this->S_GPS_LatC=="") $this->S_GPS_LatC=(MIN($this->S_GPS_Lat)+MAX($this->S_GPS_Lat))/2;
if($this->S_GPS_LonC=="") $this->S_GPS_LonC=(MIN($this->S_GPS_Lon)+MAX($this->S_GPS_Lon))/2;
}
fclose($xml_file);
}

function Camera_exifread($file){

$imgname = $file;

//$exif = new exifreader($imgname);
$exif = new exifreader($imgname);

$this->S_arr_exif = $exif->new_img_info;
}

function degree2num($degree){
//116"23.00'27
$deg = explode("\"", trim($degree));
$deg_ = explode("'", $deg[1]);
$d = $deg[0];
$m = $deg_[0];
$s = $deg_[1];

$num = $d + $m/60 + $s/3600;

return $num;
}

}


#define('maxtimediff', 120);
#define('timeoffset', 0);
#$GPS_file = 'gpx.xml';
#$GPS_file = 'gpx_loader.gpx';
#$Camera_file = "gg_gps.jpg";
#$synchronize = new synchronize($GPS_file, $Camera_file);

?>