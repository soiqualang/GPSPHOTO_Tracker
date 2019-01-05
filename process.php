<?php

/**
 * process.php - GPS PHOTO
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
 * Interface to upload and transfer GPX file and photos for timestamp synchronization
 *
 *
 * Requires synchronize.class.php extension
 */

$maxtimediff=$_POST['maxtimediff'];
$timeoffset=$_POST['timeoffset'];
$gps_opt=$_POST['gps_opt'];
$gps_op=$_POST['gps_op'];
$gps_op1=$_POST['gps_op1'];
$bupload=true;

require('synchronize.class.php');


$uploaddir = "./upload/";
$uploadfile_g = $uploaddir . basename($_FILES['GPSSelect']['name']);
$temp_name_g = $_FILES['GPSSelect']['tmp_name'];
$file_name_g = $_FILES['GPSSelect']['name'];

$uploadfile_g_3 = $uploaddir . basename($_FILES['GPSSelect_3']['name']);
$temp_name_g_3 = $_FILES['GPSSelect_3']['tmp_name'];
$file_name_g_3 = $_FILES['GPSSelect_3']['name'];

$photo_nullnr = array();
$photosnr = count($_FILES['PHOTOSelect']['name']);
#echo $photosnr;

if ($gps_opt=="gps_gp" OR $gps_opt=="gps_p") {
     foreach ($_FILES['PHOTOSelect']['name'] as $key => $val) {
      if ($val=="") {
          array_push($photo_nullnr,$key) ;
		    }
     }
     #print_r($photo_nullnr) ;
}

    $temp_name_p = $_FILES['PHOTOSelect']['tmp_name'];
    $file_name_p = $_FILES['PHOTOSelect']['name'];


for($i=0;$i<$photosnr;$i++){

    $uploadfile_p[$i] = $uploaddir . basename($_FILES['PHOTOSelect']['name'][$i]);
     // >"./upload/" ->9 string
     if(strlen($uploadfile_p[$i])>9){

     if (move_uploaded_file($temp_name_p[$i], $uploadfile_p[$i])) {
    //echo "File is valid, and was successfully uploaded.\n";
        $bupload=true;
       } else {
        $error= 'Upload Photo file unsuccessfully!';
        $bupload=false;
       }
     }
}
#print_r($uploadfile_p) ;
#print_r($file_name_p) ;


    if ($maxtimediff =="") {
         $maxtimediff = 120;
	}
    if ($S_timeoffset =="") {
	     $timeoffset = 0;
	}
	define('maxtimediff', $maxtimediff);
    define('timeoffset', $timeoffset);


//=============================================================
   if ($gps_opt=="gps_gp") {
     if (!$file_name_g ) {
     $error ="No GPX file has been selected!";
     $bupload=false;
	 }

     /*jusify whether the Array $file_name_p is empty
     *One more contents can be null, but Array can not be null
     *@ $arr_null is number of contents with null value
	 */
     $arr_null=0;
     foreach ($file_name_p as $index => $value) {
       if (empty($value)) $arr_null=$arr_null+1;
       }

     if ($arr_null == count($file_name_p)) {
		 $error ="No Photo file has been selected!";
         $bupload=false;
		 			}

	if ($file_name_g AND $arr_null < count($file_name_p)) {
    $GPS_file = $temp_name_g;
    $Camera_file = $uploadfile_p;
    #print_r($Camera_file) ;
    #print_r($photo_nullnr) ;
    $synchronize = new synchronize($GPS_file, $Camera_file, $gps_opt, $gps_op, $gps_op1, $photo_nullnr);
    }
    }//if gps_gp
//=============================================================

   if ($gps_opt=="gps_g") {

     if (!$file_name_g_3 ) {
     $error ="No GPX file has been selected!";
     $bupload=false;
	 }

	if ($file_name_g_3 ) {
    $GPS_file = $temp_name_g_3;
    $Camera_file = null;
    $synchronize = new synchronize($GPS_file, $Camera_file, $gps_opt,$gps_op, $gps_op1, $photo_nullnr);
    }
    }//if gps_g
//=============================================================

   if ($gps_opt=="gps_p") {

     /*jusify whether the Array $file_name_p is empty
     *One more contents can be null, but Array can not be null
     *@ $arr_null is number of contents with null value
	 */
     $arr_null=0;
     foreach ($file_name_p as $index => $value) {
       if (empty($value)) $arr_null=$arr_null+1;
       }

     if ($arr_null == count($file_name_p)) {
		 $error ="No Photo file has been selected!";
         $bupload=false;
		 			}

	if ($arr_null < count($file_name_p)) {
	$GPS_file = null;
    $Camera_file = $uploadfile_p;
    $synchronize = new synchronize($GPS_file, $Camera_file, $gps_opt,$gps_op, $gps_op1, $photo_nullnr);
    }
    }//if gps_p
//=============================================================

    if ($gps_opt=="") {
    $error ="Tracker Operation must be chosen!";
	}
//=============================================================
?>
<?php
		if (isset($error))//else
		{
			// Failure
		?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>PHPMyWMS Installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link href="setup.css" rel="stylesheet" type="text/css" />
</head>
<body>

            <table width="99%"  border="0" cellspacing="1" cellpadding="4">
            <tr>
            <td>
			<h1>Failure</h1>

			<p id="intro"><image src="images/im_sad.gif"  border="0">You must correct the error below before operation can continue:<br /><br />
			<span style="color:red" ><?php echo $error; ?></span><br /><br />
			<a href="javascript: history.go(-1)">Click here to go back</a>.</p>
            </td>
            </tr>
			</table>

</body>
</html>
		<?php
		}
		?>