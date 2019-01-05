<?
/**
 * exifreader.class.php - GPS PHOTO
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
 * Class to read the Exif metadata including GPS data
 *
 * Requires no extension, need PHP ExifLib
 */


class exifreader {
#public $imgtype = array();
#public $Orientation;
#public $ResolutionUnit;
#public $FocalPlaneResolutionUnit;
#public $ExposureProgram;
#public $MeteringMode_arr;
#public $Lightsource_arr;
#public $Flash_arr;
#public $GPSVersionID_arr;
#public $GPSLatitudeRef_arr;
#public $GPSLongitudeRef_arr;
#public $GPSAltitudeRef;
public $new_img_info;

function exifreader($img) {

$imgtype = array("", "GIF", "JPG", "PNG", "SWF", "PSD", "BMP", "TIFF(intel byte order)", "TIFF(motorola byte order)", "JPC", "JP2", "JPX", "JB2", "SWC", "IFF", "WBMP", "XBM");
$Orientation = array("", "top left side", "top right side", "bottom right side", "bottom left side", "left side top", "right side top", "right side bottom", "left side bottom");
$ResolutionUnit = array("", "no-unit", " inch", " centimeter");
$FocalPlaneResolutionUnit = array("", "no-unit", " inch", " centimeter");
$YCbCrPositioning = array("", "the center of pixel array", "the datum point");
$ExposureProgram = array("undefined", "manual control", "program normal", "aperture priority", "shutter priority", "program creative (slow program)", "program action(high-speed program)", "portrait mode", "landscape mode");
$MeteringMode_arr = array(
"0" => "unknown",
"1" => "average",
"2" => "center weighted average",
"3" => "spot",
"4" => "multi-spot",
"5" => "multi-segment",
"6" => "partial",
"255" => "other"
);
$Lightsource_arr = array(
"0" => "unknown",
"1" => "daylight",
"2" => "fluorescent",
"3" => "tungsten",
"10" => "flash",
"17" => "standard light A",
"18" => "standard light B",
"19" => "standard light C",
"20" => "D55",
"21" => "D65",
"22" => "D75",
"255" => "other"
);
$Flash_arr = array(
"0" => "flash did not fire",
"1" => "flash fired",
"5" => "flash fired but strobe return light not detected",
"7" => "flash fired and strobe return light detected",
);

/////////////////////////////////////////////////////
$GPSVersionID_arr = array(
"" => "Version 2.2",
"2.0.0.0" => "Version 2.0",
"2.1.0.0" => "Version 2.1",
"2.2.0.0" => "Version 2.2",
);

$GPSLatitudeRef_arr = array(
"" => "unknown",
"N" => "North latitude",
"S" => "South latitude",
);

$GPSLongitudeRef_arr = array(
"" => "unknown",
"E" => "East latitude",
"W" => "West latitude",
);
$GPSAltitudeRef = array("", "0", "Sea level", "Sea level reference (negative value)");
///////////////////////////////////////////////////////

$photoallnumb = count($img);
//$photonullnumb = count($photo_nullnr);
//$photorealnumb = $photoallnumb - $photonullnumb;


for ($i=0;$i<$photoallnumb;$i++){


@ $exif[$i] = exif_read_data ($img[$i],"IFD0");
if ($exif[$i]==false) {
$new_img_info[$i] = array ("FileInformation" => "No Image EXIF Information");
}
else
{
$exif[$i] = exif_read_data ($img[$i],0,true);

$gps_latm_=explode("/", $exif[$i][GPS][GPSLatitude][1]);
$gps_lonm_=explode("/", $exif[$i][GPS][GPSLongitude][1]);

$this->new_img_info[$i] = array (

#"FileInformation" => "-----------------------------",
"FileName" => $exif[$i][FILE][FileName],
#"FileType" => $imgtype[$exif[FILE][FileType]],
#"MimeType" => $exif[FILE][MimeType],
#"FileSize" => $exif[FILE][FileSize],
#"FileDateTime" => date("Y-m-d H:i:s",$exif[FILE][FileDateTime]),
#"ImageInformation" => "-----------------------------",
#"ImageDescription" => $exif[IFD0][ImageDescription],
#"Make" => $exif[IFD0][Make],
#"Model" => $exif[IFD0][Model],
#"Orientation" => $Orientation[$exif[IFD0][Orientation]],
#"XResolution" => $exif[IFD0][XResolution].$ResolutionUnit[$exif[IFD0][ResolutionUnit]],
#"YResolution" => $exif[IFD0][YResolution].$ResolutionUnit[$exif[IFD0][ResolutionUnit]],
#"Software" => $exif[IFD0][Software],
#"DateTime" => $exif[IFD0][DateTime],
#"Artist" => $exif[IFD0][Artist],
#"YCbCrPositioning" => $YCbCrPositioning[$exif[IFD0][YCbCrPositioning]],
#"Copyright" => $exif[IFD0][Copyright],
#"Copyright.Photographer" => $exif[COMPUTED][Copyright.Photographer],
#"Copyright.Editor" => $exif[COMPUTED][Copyright.Editor],
"DateTimeOriginal" => $exif[$i][EXIF][DateTimeOriginal],
#"DateTimeDigitized " => $exif[EXIF][DateTimeDigitized],
#"ApertureInformation" => "-----------------------------",
#"ExifVersion" => $exif[EXIF][ExifVersion],
#"FlashPixVersion" => "Ver. ".number_format($exif[EXIF][FlashPixVersion]/100,2),
#"DateTimeOriginal" => $exif[EXIF][DateTimeOriginal],
#"DateTimeDigitized" => $exif[EXIF][DateTimeDigitized],
#"Height" => $exif[COMPUTED][Height],
#"Width" => $exif[COMPUTED][Width],

/*
The actual aperture value of lens when the image was taken.
Unit is APEX.
To convert this value to ordinary F-number(F-stop),
calculate this value's power of root 2 (=1.4142).
For example, if the ApertureValue is '5', F-number is pow(1.41425,5) = F5.6.
*/

#"ApertureValue" => $exif[EXIF][ApertureValue],
#"ShutterSpeedValue" => $exif[EXIF][ShutterSpeedValue],
#"ApertureFNumber" => $exif[COMPUTED][ApertureFNumber],
#"MaxApertureValue" => "F".$exif[EXIF][MaxApertureValue],
#"ExposureTime" => $exif[EXIF][ExposureTime],
#"FNumber" => $exif[EXIF][FNumber],
#"MeteringMode" => $this->GetImageInfoVal($exif[EXIF][MeteringMode],$MeteringMode_arr),
#"LightSource" => $this->GetImageInfoVal($exif[EXIF][LightSource], $Lightsource_arr),
#"Flash" => $this->GetImageInfoVal($exif[EXIF][Flash], $Flash_arr),
#"ExposureMode" => ($exif[EXIF][ExposureMode]==1?"MANUAL":"AUTO"),
#"WhiteBalance" => ($exif[EXIF][WhiteBalance]==1?"MANUAL":"AUTO"),
#"ExposureProgram" => $ExposureProgram[$exif[EXIF][ExposureProgram]],
#"FocalPlaneXResolution" => $exif[EXIF][FocalPlaneXResolution].$FocalPlaneResolutionUnit[$exif[EXIF][FocalPlaneResolutionUnit]],
#"FocalPlaneYResolution" => $exif[EXIF][FocalPlaneYResolution].$FocalPlaneResolutionUnit[$exif[EXIF][FocalPlaneResolutionUnit]],

/*
Brightness of taken subject, unit is APEX. To calculate Exposure(Ev) from BrigtnessValue(Bv), you must add SensitivityValue(Sv).
Ev=Bv+Sv Sv=log((ISOSpeedRating/3.125),2)
ISO100:Sv=5, ISO200:Sv=6, ISO400:Sv=7, ISO125:Sv=5.32.
*/

#"ExposureBiasValue" => $exif[EXIF][ExposureBiasValue]."EV",
#"ISOSpeedRatings" => $exif[EXIF][ISOSpeedRatings],
#"ComponentsConfiguration" => (bin2hex($exif[EXIF][ComponentsConfiguration])=="01020300"?"YCbCr":"RGB"),//'0x04,0x05,0x06,0x00'="RGB" '0x01,0x02,0x03,0x00'="YCbCr"
#"CompressedBitsPerPixel" => $exif[EXIF][CompressedBitsPerPixel]."Bits/Pixel",
#"FocusDistance" => $exif[COMPUTED][FocusDistance]."m",
#"FocalLength" => $exif[EXIF][FocalLength]."mm",
#"FocalLengthIn35mmFilm" => $exif[EXIF][FocalLengthIn35mmFilm]."mm",
/*
Stores user comment. This tag allows to use two-byte character code or unicode. First 8 bytes describe the character code. 'JIS' is a Japanese character code (known as Kanji).
'0x41,0x53,0x43,0x49,0x49,0x00,0x00,0x00':ASCII
'0x4a,0x49,0x53,0x00,0x00,0x00,0x00,0x00':JIS
'0x55,0x4e,0x49,0x43,0x4f,0x44,0x45,0x00':Unicode
'0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00':Undefined
*/

#"UserCommentEncoding" => $exif[COMPUTED][UserCommentEncoding],
#"UserComment" => $exif[COMPUTED][UserComment],
#"ColorSpace" => ($exif[EXIF][ColorSpace]==1?"sRGB":"Uncalibrated"),
#"ExifImageLength" => $exif[EXIF][ExifImageLength],
#"ExifImageWidth" => $exif[EXIF][ExifImageWidth],
#"FileSource" => (bin2hex($exif[EXIF][FileSource])==0x03?"digital still camera":"unknown"),
#"SceneType" => (bin2hex($exif[EXIF][SceneType])==0x01?"A directly photographed image":"unknown"),
#"Thumbnail.FileType" => $exif[COMPUTED][Thumbnail.FileType],
#"Thumbnail.MimeType" => $exif[COMPUTED][Thumbnail.MimeType],

/*
GPS Information
*/
"GPSInformation" => "-----------------------------",
"GPSVersionID" => $this->GetImageInfoVal($exif[$i][GPS][GPSVersionID], $GPSVersionID_arr),
"GPSLatitudeRef" => $this->GetImageInfoVal($exif[$i][GPS][GPSLatitudeRef], $GPSLatitudeRef_arr),
"GPSLatitude" => number_format($exif[$i][GPS][GPSLatitude][0])."\"".number_format($exif[$i][GPS][GPSLatitude][1]/($gps_latm_[1]=="1"?"1":"100"),2)."'".number_format($exif[$i][GPS][GPSLatitude][2]),
"GPSLongitudeRef" => $this->GetImageInfoVal($exif[$i][GPS][GPSLongitudeRef], $GPSLongitudeRef_arr),
"GPSLongitude" => number_format($exif[$i][GPS][GPSLongitude][0])."\"".number_format($exif[$i][GPS][GPSLongitude][1]/($gps_lonm_[1]=="1"?"1":"100"),2)."'".number_format($exif[$i][GPS][GPSLongitude][2]),
"GPSAltitudeRef" => $GPSAltitudeRef[$exif[$i][GPS][GPSAltitudeRef]],
"GPSAltitude" => $exif[$i][GPS][GPSAltitude],
"GPSTimeStamp" => number_format($exif[$i][GPS][GPSTimeStamp][0]).":".number_format($exif[$i][GPS][GPSTimeStamp][1]).":".number_format($exif[$i][GPS][GPSTimeStamp][2])." UTC",
"GPSMapDatum" => $exif[$i][GPS][GPSMapDatum],
"=====" => "=============================",

);

  //if ($i==0) {
  //$array = array();
  	//$new_img_info[$i] = array_push($array,$new_img_info[$i]);
  //}
  //else {$new_img_info[$i] = array_push($new_img_info[$i-1],$new_img_info[$i]);}
//print_r($exif[GPS][GPSVersionID]);
}
//return $new_img_info[$i];
}//for


}

function GetImageInfoVal($ImageInfo,$val_arr) {
$InfoVal = "unknown";
foreach($val_arr as $name=>$val) {
if ($name==$ImageInfo) {
$InfoVal = &$val;
break;
}
}
return $InfoVal;
}



    /**
     * Returns thumbnail url along with parameter supplied.
     * Should be called in src attribute of image
     *
     * @return  string  File URL
     *
     */
    function showThumbnail($img) {
        return "showThumbnail.php?file=".$img;
        //$this->ImageInfo["h"]["Thumbnail"]
    }

}//class



#$innerhtml = "";
##$imgname = "s_gps.jpg";
#$photo_nullnr = Array ( "1", "3" );
#$imgname = Array( "upload/gps_a1.jpg", "C:/Apache/Apache2/htdocs/test/GPSPhoto/upload/", "C:/Apache/Apache2/htdocs/test/GPSPhoto/upload/s_gps.jpg", "C:/Apache/Apache2/htdocs/test/GPSPhoto/upload/" );
#//$exif = new exifreader($imgname);
#$exif = new exifreader($imgname, $photo_nullnr);
#
#//print_r($exif->new_img_info) ;
#
#$countphotoall = count($imgname);
#
#for($i=0;$i<$countphotoall;$i++){
#
#$innerhtml .= "<TABLE>";
#
#if ($exif->new_img_info[$i]!=null) {
#
#    foreach($exif->new_img_info[$i] as $name=>$val) {
#       if ($val=="") {
#	       $val="unkonwn";
#	      }
#        $innerhtml .= "<TR><TD>{$name}</TD><TD>{$val}</TD></TR>";
#         }
#	}
##$innerhtml .= "<TR><TD colspan=\"2\">";
##if ($img) {
##$image = exif_thumbnail($img);
##} else {
##$image = false;
##}
##if ($image!==false) {
##//$innerhtml .= "<img src=\"showThumbnail.php?file=".$img."\">";
##//echo "<img src='".showThumbnail($img)."'>";
##} else {
##// no thumbnail available, handle the error here
##$innerhtml .= "No thumbnail available";
##}
#
#
#//$innerhtml .= "</TD></TR>";
#$innerhtml .= "</TABLE>";
#
#}//for
#echo $innerhtml;

?>





