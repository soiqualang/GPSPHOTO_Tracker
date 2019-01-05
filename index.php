<?php

/**
 * index.php - GPS PHOTO
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
 * @copyright    leelight (c)2006-2007
 * @link         http://gpsphoto.easywms.com
 * @version      1.0
 * @filesource
 */

/**
 * Index for the user interface to select GPX file and photos
 *
 * Requires no extension
 */
include_once 'config.php';
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>GPS PHOTO Tracker</title>
<meta http-equiv="keywords" content="GPS PHOTO Tracker, GPX, Ajax, PHP, Googlemap, XML, GPSPHOTO, WEBGIS, Exif, JPEG">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="setup.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript" language="javascript" src="common.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="photoscreate.js"></script>
</head>
<body>


<form name="FormsGpsphoto" enctype="multipart/form-data" action="process.php" method="post" onSubmit="return chkinput() ">
                    <table width="99%"  border="0" cellspacing="1" cellpadding="4">
                    	<tr >
                    		<td colspan="2">
<image src="images/gpsphoto.gif" width="350" height="80" border="0">
<p class="intro" align="center">GPSPHOTO Tracker <?echo $softVersion.$softEdition;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="indexcn.php"><image src="images/flag_cn.jpg" width="22" height="16" border="0"></a></p></td>

                   		</tr>
                   		<tr>
                    		<td  class=contenttopl width=25%>Input Maximal Time Difference</td>
                    		<td class=contenttopr width=75% align=right><a id=xcontent1 onclick="ShowHide('content1');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content1>
                    		Maximal Time Difference:
							<image src="images/im_help.png"  border="0" onmouseover="tooltip('Maximal Time Difference','Description:','Maximal time difference given in seconds between the image timestamp and the timestamps in the gpx file. Image that have the smallest time differences will get the corresponding coordinate. <br>If you omit this parameter, a default of 120 seconds will be used.');" onmouseout="exit();">
                            <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							    <input name="maxtimediff" type="text" id="maxtimediff" size="3" value="120"  class="smallInput"/>
							    <select NAME="TEMP" onchange="document.FormsGpsphoto.maxtimediff.value =this.options[this.selectedIndex].value" class="button4"/>
							    <option value="120">seconds</option>
							    <option value="60">1 minute</option>
							    <option value="120">2 minutes</option>
							    <option value="180">3 minutes</option>
							    <option value></option>
							    </select>
							 </DIV>
							 <DIV id=mcontent1>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                    		<td class=contenttopl width=25%>Input Time Offset</td>
                   		    <td class=contenttopr width=75% align=right><a id=xcontent2 onclick="ShowHide('content2');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
							<DIV id=content2>
							Time Offset:
							<image src="images/im_help.png"  border="0" onmouseover="tooltip('Time Offset','Description:','Timeoffset given in seconds between the camera and the gps device.This can be used f.e. time in UTC time and local time, wrong time set in camera.A value of 3600 means one hour time difference where the camera is one hour behind in time.<br>A positive value means that the camera is behind in time, a negative value means that the camera is ahead in time.<br>If you omit this parameter, a default of 0 seconds will be used.');" onmouseout="exit();">
                    		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="timeoffset" type="text" id="timeoffset" size="8" maxlength="8" value="0" class="smallInput"/>
							    <select NAME="TEMP" onchange="document.FormsGpsphoto.timeoffset.value =this.options[this.selectedIndex].value" class="button4"/>
							    <option value="0">seconds</option>
							    <option value="3600">1 hour</option>
							    <option value="3600*2">2 hours</option>
							    <option value="3600*3">3 hours</option>
							    <option value="3600*4">4 hours</option>
							    <option value="3600*5">5 hours</option>
							    <option value="3600*6">6 hours</option>
							    <option value="3600*7">7 hours</option>
							    <option value="3600*8">8 hours</option>
							    <option value="3600*9">9 hours</option>
							    <option value="3600*10">10 hours</option>
							    <option value="3600*11">11 hours</option>
							    <option value="3600*12">12 hours</option>
							    <option value="-3600">-1 hour</option>
							    <option value="-3600*2">-2 hours</option>
							    <option value="-3600*3">-3 hours</option>
							    <option value="-3600*4">-4 hours</option>
							    <option value="-3600*5">-5 hours</option>
							    <option value="-3600*6">-6 hours</option>
							    <option value="-3600*7">-7 hours</option>
							    <option value="-3600*8">-8 hours</option>
							    <option value="-3600*9">-9 hours</option>
							    <option value="-3600*10">-10 hours</option>
							    <option value="-3600*11">-11 hours</option>
							    <option value="-3600*12">-12 hours</option>
							    <option value></option>
							    </select>
							    </DIV>
							 <DIV id=mcontent2>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                    		<td class=contenttopl width=25%>Tracker Operation</td>
                    	<td class=contenttopr width=75% align=right><a id=xcontent3 onclick="ShowHide('content3');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content3>
							Write GPS Metadata to photos: <image src="images/im_help.png"  border="0" onmouseover="tooltip('GPS Metadata','','You can download the new photos with GPS metadata, all original Exif metadata will be kept.');" onmouseout="exit();">
                    		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="gps_op" value="wr_gps" class="button3">GPS Exif-metadata will be written in photos.<br><br>

                    		Output KML file for Google Earth: <image src="images/im_help.png"  border="0" onmouseover="tooltip('KML file for Google Earth','','You can use GoogleEarth to open this KML file.');" onmouseout="exit();">
                    		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="gps_op1" value="wr_kml" class="button3">Google Earth KML file will be outputted.<br>
                    		</DIV>
							 <DIV id=mcontent3>&nbsp;</DIV>
                            </td>
                   		</tr>
                  		<tr>
                  		<td class=contenttopl width=25%>Which way to track: <image src="images/im_help.png"  border="0" onmouseover="tooltip('Track Example','Track Result Example :','<br><br><image src=images/gpsphotoi.gif  border=0>');" onmouseout="exit();"></td>
                    	<td class=contenttopr width=75% align=right><a id=xcontent4 onclick="ShowHide('content4');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                    		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content4>
                    		<input type="radio" name= "gps_opt"  value="gps_p" class="button3" onClick="show_tbl('content1_',3,1)" style="cursor:hand;">
                                 I have GPSPhotos, but without GPX file, I just want to track my GPSPhotos using Google Maps.
                                 <br>
                                <input type="radio" name= "gps_opt"  value="gps_gp" class="button3" onClick="show_tbl('content1_',3,2)" style="cursor:hand;" CHECKED>
                                 I have Normal or GPS Photos, and GPX file, I want to track my Photos according GPX file using Google Maps.
                                 <br>
                                <input type="radio" name= "gps_opt"  value="gps_g" class="button3" onClick="show_tbl('content1_',3,3)" style="cursor:hand;">
                                 I have only a GPX file, I want to track my GPX file using Google Maps.
                                 </DIV>
							 <DIV id=mcontent4>&nbsp;</DIV>
                                </td>
                   		</tr>
                   		<tr>
                    		<td><font class=notice>NOTICE: </font></td>
                    		<td><p class="intro"><font class=notice>
	 Please run GPSPHOTO Tracker in a new browser window after having
finished one operation, otherwise Google map might display error messages</font></p><br>
                                </td>
                   		</tr>
                   		<tr>
                    		<td colspan="2"><h3>Upload Files</h3><br></td>
                   		</tr>
                   	<!--begin content1_1-->
                   		<table id="content1_1"  style="display:none" width="99%"  border="0">
                   		<tr>
                    		<td>How many photos will you upload:</td>
                    		<td><input name="photosCal_1" type="text" id="photosCal_1" size="2" maxlength="2" value="1" class="smallInput"/>
                                <a href="javascript:sndReq_1();">Create Upload Operation</a>
							</td>
                   		</tr>
                   		<tr>
                    		<td>Select Photo File:</td>
                    		<td><div id="divId_1"><div></td>
                   		</tr>
                   		</table>
                        <!--content1_2 -->
                   		<table id="content1_2" width="99%"  border="0" >
                   		<tr>
                    		<td>Select GPX File:</td>
                    		<td><input type="file" name="GPSSelect" class="button2"/></td>
                   		</tr>
                   		<tr>
                    		<td>How many photos will you upload:</td>
                    		<td><input name="photosCal_2" type="text" id="photosCal_2" size="2" maxlength="2" value="1" class="smallInput"/>
                                <a href="javascript:sndReq_2();">Create Upload Operation</a>
							</td>
                   		</tr>
                   		<tr>
                    		<td>Select Photo File:</td>
                    		<td><div id="divId_2"><div></td>
                   		</tr>
                   		</table>
                        <!--content1_3 -->
                   		<table id="content1_3"  style="display:none" width="99%"  border="0">
                   		<tr>
                    		<td>Select GPX File:</td>
                    		<td><input type="file" name="GPSSelect_3" class="button2"/></td>
                   		</tr>
                   		</table>
                        <!--end -->
                   		<tr align="right">
                    		<td><input type="hidden" name="max_file_size" value="100000"></td>
                    		<td><input type="submit" name="FileUpload" value="Upload" onmouseover="this.className='button1'" onmouseout="this.className='button'" class="button"/></td>
                   		</tr>

                   	</table>
</form>

<table width="99%"  border="0" cellspacing="1" cellpadding="4">
                    	<tr>
                    		<td colspan="2"><h3>Download Example File For Test</h3></td>
                   		</tr>
                        <tr>
                    	    <td class=contenttopl width=25%>1. GPX File and Normal Photos:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent9 onclick="ShowHide('content9');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content9>
                    		<a href="images/a/agpx.xml" target="_blank">GPX file download</a><br><br>
                            <a href="images/a/a1.jpg" target="_blank"><image src="images/a/a1.jpg" width="100" height="70" border="0"></a>
                            <a href="images/a/a2.jpg" target="_blank"><image src="images/a/a2.jpg" width="100" height="70" border="0"></a>
                            <a href="images/a/a3.jpg" target="_blank"><image src="images/a/a3.jpg" width="100" height="70" border="0"></a>
							<a href="images/a/a4.jpg" target="_blank"><image src="images/a/a4.jpg" width="100" height="70" border="0"></a>
                            <a href="images/a/a5.jpg" target="_blank"><image src="images/a/a5.jpg" width="100" height="70" border="0"></a>
                            <a href="images/a/a6.jpg" target="_blank"><image src="images/a/a6.jpg" width="100" height="70" border="0"></a>
                            </DIV>
							 <DIV id=mcontent9>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                   	    	<td class=contenttopl width=25%>2. GPS Photos:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent10 onclick="ShowHide('content10');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content10>
                            <a href="images/gpsa/gps_a1.jpg" target="_blank"><image src="images/gpsa/gps_a1.jpg" width="100" height="70" border="0"></a>
                            <a href="images/gpsa/gps_a2.jpg" target="_blank"><image src="images/gpsa/gps_a2.jpg" width="100" height="70" border="0"></a>
                            <a href="images/gpsa/gps_a3.jpg" target="_blank"><image src="images/gpsa/gps_a3.jpg" width="100" height="70" border="0"></a>
							<a href="images/gpsa/gps_a4.jpg" target="_blank"><image src="images/gpsa/gps_a4.jpg" width="100" height="70" border="0"></a>
                            <a href="images/gpsa/gps_a5.jpg" target="_blank"><image src="images/gpsa/gps_a5.jpg" width="100" height="70" border="0"></a>
                            <a href="images/gpsa/gps_a6.jpg" target="_blank"><image src="images/gpsa/gps_a6.jpg" width="100" height="70" border="0"></a>
							</DIV>
							 <DIV id=mcontent10>&nbsp;</DIV>
							</td>
                   		</tr>
                        <tr>
                   	    	<td class=contenttopl width=25%>2. Support & FAQ & Forum:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent11 onclick="ShowHide('content11');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content11>
                            <a href="http://www.easywms.com/easywms/?q=en/taxonomy/term/14" target="_blank">Support & FAQ</a><br><br>
                            <a href="http://www.easywms.com/easywms/?q=en/forum/10" target="_blank">Go to Forum</a>
							</DIV>
							 <DIV id=mcontent11>&nbsp;</DIV>
							</td>
                   		</tr>
                        <tr>
                    		<td colspan="2"><h3>&nbsp; </h3></td>
                   		</tr>
                    		<td colspan="2" align="center" class="foot">
                                Visitors:
     <? include_once 'counter/counter.php'; $style=0; style($style); ?>
     &nbsp; &nbsp;
	 <image src="images/im_smile.gif"  border="0"><br>
	 <a href="http://www.easywms.com">Copyright &copy; EasyWMS 2006-2007 </a>
				</td>
                   		</tr>
</table>


</body>
</html>