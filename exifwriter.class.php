<?php

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
 * Class to write the Exif GPS metadata into new photo
 *
 * Requires PHP_JPEG_Metadata_Toolkit_1.11 extension, author:Evan Hunter
 * http://www.ozhiker.com/electronics/pjmt/ , Thx!!!
 */

include "PHP_JPEG_Metadata_Toolkit_1.11/EXIF.php";

class exifwriter {



function exifwriter($lat, $lon, $ele, $photonum ,$photoname, $phototime) {

      $Photo_GPSMapDatum = "WGS84";

      $num_allphoto = max(array_keys($photonum))+1;
	  for($l=0;$l<$num_allphoto;$l++){
         if ($photoname[$l]!=null) {
         //Remove the non-GPSPhoto
         if ($lon[$photonum[$l]]!=0 AND $lat[$photonum[$l]]!=0) {

             $jpeg_orig_header_data = get_jpeg_header_data( $GLOBALS['Photo_dir'].$photoname[$l] );

             $metadata_all = get_EXIF_JPEG( $GLOBALS['Photo_dir'].$photoname[$l]);

             $metadata_gps = $metadata_all[0][34853]; //GPS Info Image File Directory

             $metadata_gps["Tag Number"] = 34853;
             $metadata_gps["Tag Name"] = "GPS Info Image File Directory (IFD)";
             $metadata_gps["Tag Description"] = "";
             $metadata_gps["Data Type"] = 4;
             $metadata_gps["Type"] = "SubIFD";
             $metadata_gps["Units"] = "";
             $metadata_gps["Text Value"] ="";
             $metadata_gps["Decoded"] = 1;

             $metadata_gps_data = $metadata_gps[Data];
             $metadata_gps_data_0 = $metadata_gps_data[0];//GPS

             $metadata_gps_data_0["Tags Name"] = "GPS";
             $metadata_gps_data_0["Tiff Offset"] = 30;

             $metadata_gps_data_0_0 = $metadata_gps_data[0][0];//GPS Tag Version
             //======GPS Tag Version=========================================
             $metadata_gps_data_0_0["Tag Number"] = 0;
             $metadata_gps_data_0_0["Tag Name"] = "GPS Tag Version";
             $metadata_gps_data_0_0["Tag Description"] = "";
             $metadata_gps_data_0_0["Data Type"] = 1;
             $metadata_gps_data_0_0["Type"] = "Numeric";
             $metadata_gps_data_0_0["Units"] = "(e.g.: 2.2.0.0 = Version 2.2 )";
             $metadata_gps_data_0_0["Data"] = Array
                                (
                                    "0" => 2,
                                    "1" => 2,
                                    "2" => 0,
                                    "3" => 0
                                );

             $metadata_gps_data_0_0["Text Value"] = "2,2,0,0 (e.g.: 2.2.0.0 = Version 2.2 )";
             $metadata_gps_data_0_0["Decoded"] = 1;


             $metadata_gps_data_0_1 = $metadata_gps_data[0][1];//North or South Latitude
             //======North or South Latitude=========================================
             $metadata_gps_data_0_1["Tag Number"] = 1;
             $metadata_gps_data_0_1["Tag Name"] = "North or South Latitude";
             $metadata_gps_data_0_1["Tag Description"] ="";
             $metadata_gps_data_0_1["Data Type"] = 2;
             $metadata_gps_data_0_1["Type"] = "String";
             $metadata_gps_data_0_1["Units"] ="";
             if ($lat[$photonum[$l]]>=0 AND $lat[$photonum[$l]]<=90) {
             $metadata_gps_data_0_1["Data"] = Array
                                (
                                    "0" => "N"
                                );

             $metadata_gps_data_0_1["Text Value"] = "N";
			 }
             elseif ($lat[$photonum[$l]]>= -90 AND $lat[$photonum[$l]]<0) {
             $metadata_gps_data_0_1["Data"] = Array
                                (
                                    "0" => "S"
                                );

             $metadata_gps_data_0_1["Text Value"] = "S";
             }
             $metadata_gps_data_0_1["Decoded"] = 1;


             $metadata_gps_data_0_2 = $metadata_gps_data[0][2];//Latitude
             //======Latitude=========================================
             $metadata_gps_data_0_2["Tag Number"] = 2;
             $metadata_gps_data_0_2["Tag Name"] = "Latitude";
             $metadata_gps_data_0_2["Tag Description"] ="";
             $metadata_gps_data_0_2["Data Type"] = 5;
             $metadata_gps_data_0_2["Type"] = "Numeric";
             $metadata_gps_data_0_2["Units"] = "(Degrees Minutes Seconds North or South)";

             $lat_D = $this->num2degree($lat[$photonum[$l]]);
             $metadata_gps_data_0_2["Data"][0] = Array
                                        (
                                            "Numerator" => $lat_D[0],
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_2["Data"][1] = Array
                                        (
                                            "Numerator" => $lat_D[1],
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_2["Data"][2] = Array
                                        (
                                            "Numerator" => $lat_D[2],
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_2["Text Value"] = $lat_D[0]."/1 (".$lat_D[0]."),".$lat_D[1]."/1 (".$lat_D[1]."),".$lat_D[2]."/1 (".$lat_D[2].") (Degrees Minutes Seconds North or South)";
             $metadata_gps_data_0_2["Decoded"] = 1;


             $metadata_gps_data_0_3 = $metadata_gps_data[0][3];//East or West Longitude
             //======East or West Longitude=========================================
             $metadata_gps_data_0_3["Tag Number"] = 3;
             $metadata_gps_data_0_3["Tag Name"] = "East or West Longitude";
             $metadata_gps_data_0_3["Tag Description"] ="";
             $metadata_gps_data_0_3["Data Type"] = 2;
             $metadata_gps_data_0_3["Type"] = "String";
             $metadata_gps_data_0_3["Units"] ="";
             if ($lon[$photonum[$l]]>=-180 AND $lon[$photonum[$l]]<=0) {
             $metadata_gps_data_0_3["Data"] = Array
                                (
                                    "0" => "W"
                                );
             $metadata_gps_data_0_3["Text Value"] = "W";
             //echo "w";
			 }
             elseif ($lat[$photonum[$l]]> 0 AND $lat[$photonum[$l]]<=180) {
             $metadata_gps_data_0_3["Data"] = Array
                                (
                                    "0" => "E"
                                );
             $metadata_gps_data_0_3["Text Value"] = "E";
             //echo "e";
             }
             $metadata_gps_data_0_3["Decoded"] = 1;


             $metadata_gps_data_0_4 = $metadata_gps_data[0][4];//Longitude
             //======Longitude=========================================
             $metadata_gps_data_0_4["Tag Number"] = 4;
             $metadata_gps_data_0_4["Tag Name"] = "Longitude";
             $metadata_gps_data_0_4["Tag Description"] ="";
             $metadata_gps_data_0_4["Data Type"] = 5;
             $metadata_gps_data_0_4["Type"] = "Numeric";
             $metadata_gps_data_0_4["Units"] = "(Degrees Minutes Seconds East or West)";

             $lon_D = $this->num2degree($lon[$photonum[$l]]);
             $metadata_gps_data_0_4["Data"][0] = Array
                                        (
                                            "Numerator" => $lon_D[0],
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_4["Data"][1] = Array
                                        (
                                            "Numerator" => $lon_D[1],
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_4["Data"][2] = Array
                                        (
                                            "Numerator" => $lon_D[2],
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_4["Text Value"] = $lon_D[0]."/1 (".$lon_D[0]."),".$lon_D[1]."/1 (".$lon_D[1]."),".$lon_D[2]."/1 (".$lon_D[2].") (Degrees Minutes Seconds East or West)";
             $metadata_gps_data_0_4["Decoded"] = 1;

             //2002-07-13 16:00:02
             $t = explode(" ", $phototime[$l]);
             $time = explode(":", $t[1]);
             $time_h = $time[0];
             $time_m = $time[1];
             $time_s = $time[2];

             $metadata_gps_data_0_7 = $metadata_gps_data[0][7];//GPS Time (atomic clock)
             //======GPS Time (atomic clock)=========================================
             $metadata_gps_data_0_7["Tag Number"] = 7;
             $metadata_gps_data_0_7["Tag Name"] = "GPS Time (atomic clock)";
             $metadata_gps_data_0_7["Tag Description"] ="";
             $metadata_gps_data_0_7["Data Type"] = 5;
             $metadata_gps_data_0_7["Type"] = "Numeric";
             $metadata_gps_data_0_7["Units"] = "(Hours Minutes Seconds)";

             $metadata_gps_data_0_7["Data"][0] = Array
                                        (
                                            "Numerator" => $time_h,
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_7["Data"][1] = Array
                                        (
                                            "Numerator" => $time_m,
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_7["Data"][2] = Array
                                        (
                                            "Numerator" => $time_s,
                                            "Denominator" => 1
                                        );

             $metadata_gps_data_0_7["Text Value"] = $time_h."/1 (".$time_h."),".$time_m."/1 (".$time_m."),".$time_s."/1 (".$time_s.") (Hours Minutes Seconds)";
             $metadata_gps_data_0_7["Decoded"] = 1;

             $date = explode("-", $t[0]);
             $date_y = $date[0];
             $date_m = $date[1];
             $date_m = $date[2];

             $metadata_gps_data_0_29 = $metadata_gps_data[0][29];//GPS Date
             //======GPS Date=========================================
             $metadata_gps_data_0_29["Tag Number"] = 29;
             $metadata_gps_data_0_29["Tag Name"] = "GPS Date";
             $metadata_gps_data_0_29["Tag Description"] ="";
             $metadata_gps_data_0_29["Data Type"] = 2;
             $metadata_gps_data_0_29["Type"] = "Numeric";
             $metadata_gps_data_0_29["Units"] =  "(Format: YYYY:MM:DD HH:mm:SS)";
             $metadata_gps_data_0_29["Data"] = Array
                                (
                                    "0" => $date_y.":".$date_m.":".$date_m
                                );

             $metadata_gps_data_0_29["Text Value"] = $date_y.":".$date_m.":".$date_m."  (Format: YYYY:MM:DD HH:mm:SS)";
             $metadata_gps_data_0_29["Decoded"] = 1;


             $metadata_gps_data_0_18 = $metadata_gps_data[0][18];//Geodetic Survey Datum Used
             //======Geodetic Survey Datum Used=========================================
             $metadata_gps_data_0_18["Tag Number"] = 18;
             $metadata_gps_data_0_18["Tag Name"] = "Geodetic Survey Datum Used";
             $metadata_gps_data_0_18["Tag Description"] ="";
             $metadata_gps_data_0_18["Data Type"] = 2;
             $metadata_gps_data_0_18["Type"] = "String";
             $metadata_gps_data_0_18["Units"] ="";
             $metadata_gps_data_0_18["Data"] = Array
                                        (
                                            "0" => $Photo_GPSMapDatum
                                        );

             $metadata_gps_data_0_18["Text Value"] = $Photo_GPSMapDatum;
             $metadata_gps_data_0_18["Decoded"] = 1;

             //=======rebuild the metadata array====================================================
             $metadata_gps_data[0] = $metadata_gps_data_0;
             $metadata_gps_data[0][0] = $metadata_gps_data_0_0;
             $metadata_gps_data[0][1] = $metadata_gps_data_0_1;
             $metadata_gps_data[0][2] = $metadata_gps_data_0_2;
             $metadata_gps_data[0][3] = $metadata_gps_data_0_3;
             $metadata_gps_data[0][4] = $metadata_gps_data_0_4;
             $metadata_gps_data[0][7] = $metadata_gps_data_0_7;
             $metadata_gps_data[0][29] = $metadata_gps_data_0_29;
             $metadata_gps_data[0][18] = $metadata_gps_data_0_18;

             $metadata_gps[Data] = $metadata_gps_data;
             $metadata_all[0][34853] = $metadata_gps;
             //===========================================================

             //print_r($metadata_all);
             $jpeg_orig_header_data = put_EXIF_JPEG( $metadata_all, $jpeg_orig_header_data );
             //print_r($jpeg_orig_header_data);
             $original_filename = $GLOBALS['Photo_dir'].$photoname[$l];
             $new_filename = $GLOBALS['Photo_dir'].$GLOBALS['Photo_prefix'].$photoname[$l];

             put_jpeg_header_data( $original_filename, $new_filename, $jpeg_orig_header_data );
			 $metadata_all = array();

             //=============resample============================================
#             $jpeg_quality = 75;
#             $new_width = 300;
#             $new_height = 200;
#
#             list($width, $height) = getimagesize( $original_filename );
#             $new_image = imagecreatetruecolor($width, $height);
#             $original_image = imagecreatefromjpeg( $original_filename );
#             imagecopyresampled ( $new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
#             imagejpeg( $new_image, $new_filename, $jpeg_quality);
#
#             // Get Header for new image
#             $new_jpeg_header_data = get_jpeg_header_data( $new_filename );
#             $final_new_jpeg_header_data = array();
#
#             // Extract and save the APP & COM segments from the original file
#             foreach( $jpeg_orig_header_data as $seg )
#             {
#               // Is segment an APP or COM segment?
#               if ( ( ( $seg[ "SegType"] >= 0xE0 ) && ( $seg[ "SegType"] <= 0xEF ) ) || ( $seg[ "SegType"] == 0xFE ) )
#             {
#             $final_new_jpeg_header_data[] = $seg;
#             }
#             }
#
#             // Append all other segments from the new resized file to the APP & COM segments from the original
#             foreach( $new_jpeg_header_data as $seg )
#             {
#               // Is segment not an APP or COM segment?
#               if ( ( ( $seg[ "SegType"] < 0xE0 ) || ( $seg[ "SegType"] > 0xEF ) ) && ( $seg[ "SegType"] != 0xFE ) )
#             {
#             $final_new_jpeg_header_data[] = $seg;
#             }
#             }
#
#
#             put_jpeg_header_data( $new_filename, $new_filename, $final_new_jpeg_header_data );
              //=============resample============================================


						}
                        }
                        #echo "c";
						}

}


function num2degree($num){
//120.5597=>120"33'35

$deg = explode(".", trim(abs($num)));
$d = $deg[0]; //90
$m_ = explode(".", ("0.".$deg[1])*60);
$m = $m_[0];
$s = ("0.".$m_[1])*60    ;

//$degree = $d."\"".$m.."\"".$s;
$degree = array($d, $m, $s);
return $degree;
}


}

//$exifwriter = new exifwriter($lat, $lon, $ele, $photonum ,$photoname, $phototime);
//print_r($exifwriter->num2degree(-84.82118));
?>