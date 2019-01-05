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

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<title>GPS PHOTO Tracker</title>
<meta http-equiv="keywords" content="GPS PHOTO Tracker, GPX, Ajax, PHP, Googlemap, XML, GPSPHOTO, WEBGIS, Exif, JPEG">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312"/>
<link href="setup.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript" language="javascript" src="common.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="photoscreate.js"></script>

</head>
<body>
<script src="nav.js"></script>

<form name="FormsGpsphoto" enctype="multipart/form-data" action="process.php" method="post" onSubmit="return chkinput() ">
                    <table width="99%"  border="0" cellspacing="1" cellpadding="4">
                    	<tr >
                    		<td colspan="2">
<image src="images/gpsphoto.gif" width="350" height="80" border="0">
<p class="intro" align="center">GPSPHOTO Tracker <?echo $softVersion.$softEdition;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php"><image src="images/flag_en.jpg" width="22" height="16" border="0"></a></p></td>

                   		</tr>
                   		<tr>
                                <td  class=contenttopl width=25%>输入最大时间误差</td>
                    		<td class=contenttopr width=75% align=right><a id=xcontent1 onclick="ShowHide('content1');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content1>
                                最大时间误差: <image src="images/im_help.png"  border="0" onmouseover="tooltip('最大时间误差','描述: ','以秒计的最大时间误差是图片的成片时间与GPX文件的时间点的差值，拥有最小时间误差的图片将获取相应的座标. <br>如果您忽略此值, 默认值为120秒.');" onmouseout="exit();">
                               <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							    <input name="maxtimediff" type="text" id="maxtimediff" size="3" value="120"  class="smallInput"/>
							    <select NAME="TEMP" onchange="document.FormsGpsphoto.maxtimediff.value =this.options[this.selectedIndex].value" class="button4"/>
							    <option value="120">秒</option>
							    <option value="60">1 分钟</option>
							    <option value="120">2 分钟</option>
							    <option value="180">3 分钟</option>
							    <option value></option>
							    </select>
                                                          </DIV>
							 <DIV id=mcontent1>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                                    <td class=contenttopl width=25%>输入时差</td>
                   		    <td class=contenttopr width=75% align=right><a id=xcontent2 onclick="ShowHide('content2');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
							<DIV id=content2>
时差: <image src="images/im_help.png"  border="0" onmouseover="tooltip('时差','描述:','以秒计的时差是数码相机和GPS装置的时间差值.如两种装置使用不同时间，UTC标准时或当地时间,或者相机使用了错误的时间设置.3600表示一个小时的时差，意味相机时间落后GPS装置一小时.<br>正值表示相机落后时间,负值表示相机超前时间.<br>如果您忽略此值, 默认值为0秒.');" onmouseout="exit();">
                                <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    		<input name="timeoffset" type="text" id="timeoffset" size="8" maxlength="8" value="0" class="smallInput"/>
							    <select NAME="TEMP" onchange="document.FormsGpsphoto.timeoffset.value =this.options[this.selectedIndex].value" class="button4"/>
							    <option value="0">秒</option>
							    <option value="3600">1 小时</option>
							    <option value="3600*2">2 小时</option>
							    <option value="3600*3">3 小时</option>
							    <option value="3600*4">4 小时</option>
							    <option value="3600*5">5 小时</option>
							    <option value="3600*6">6 小时</option>
							    <option value="3600*7">7 小时</option>
							    <option value="3600*8">8 小时</option>
							    <option value="3600*9">9 小时</option>
							    <option value="3600*10">10 小时</option>
							    <option value="3600*11">11 小时</option>
							    <option value="3600*12">12 小时</option>
							    <option value="-3600">-1 小时</option>
							    <option value="-3600*2">-2 小时</option>
							    <option value="-3600*3">-3 小时</option>
							    <option value="-3600*4">-4 小时</option>
							    <option value="-3600*5">-5 小时</option>
							    <option value="-3600*6">-6 小时</option>
							    <option value="-3600*7">-7 小时</option>
							    <option value="-3600*8">-8 小时</option>
							    <option value="-3600*9">-9 小时</option>
							    <option value="-3600*10">-10 小时</option>
							    <option value="-3600*11">-11 小时</option>
							    <option value="-3600*12">-12 小时</option>
							    <option value></option>
							    </select>
                                                         </DIV>
							 <DIV id=mcontent2>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                                  <td class=contenttopl width=25%>操作选择</td>
                    	          <td class=contenttopr width=75% align=right><a id=xcontent3 onclick="ShowHide('content3');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content3>
写入GPS元数据: <image src="images/im_help.png"  border="0" onmouseover="tooltip('写入GPS元数据','','您可以下载新的包含GPS元数据的图片，图片原有的元数据将被保留.');" onmouseout="exit();">
<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    		<input type="checkbox" name="gps_op" value="wr_gps" class="button3">GPS Exif 元数据将被写入到图片中.<br><br>

                               输出Google Earth KML文件: <image src="images/im_help.png"  border="0" onmouseover="tooltip('输出Google Earth KML文件','','您可以使用GoogleEarth打开KML文件.');" onmouseout="exit();">
                    		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="gps_op1" value="wr_kml" class="button3">Google Earth KML文件将被输出.<br>
                                </DIV>
							 <DIV id=mcontent3>&nbsp;</DIV>
                                </td>
                   		</tr>
                              <td class=contenttopl width=25%>追踪方式: <image src="images/im_help.png"  border="0" onmouseover="tooltip('追踪样例:','最终结果样例: ','<br><br><image src=images/gpsphotoi.gif  border=0>');" onmouseout="exit();"></td>
                    	<td class=contenttopr width=75% align=right><a id=xcontent4 onclick="ShowHide('content4');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                  		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content4>
                                <input type="radio" name= "gps_opt"  value="gps_p" class="button3" onClick="show_tbl('content1_',3,1)" style="cursor:hand;">
                                 我有GPS图片，但是没有GPX文件，我只想使用Google Map追踪GPS图片。
                                 <br>
                                <input type="radio" name= "gps_opt"  value="gps_gp" class="button3" onClick="show_tbl('content1_',3,2)" style="cursor:hand;" CHECKED>
                                 我有普通或GPS图片和GPX文件，我想使用Google Map，依据GPX文件追踪图片。
                                 <br>
                                <input type="radio" name= "gps_opt"  value="gps_g" class="button3" onClick="show_tbl('content1_',3,3)" style="cursor:hand;">
                                 我只有GPX文件，我只想使用Google Map追踪此文件。
                                  </DIV>
							 <DIV id=mcontent4>&nbsp;</DIV>
                                </td>
                   		</tr>
                   		<tr>
                    		<td><font class=notice>注意: </font></td>
                    		<td><p class="intro"><font class=notice>
                    		请在结束一个操作时新开一个新的浏览器窗口来执行新的操作，
                    		否则Google map可能会出现错误显示。
                                </font></p><br>
                                </td>
                   		</tr>
                   		<tr>
                    		<td colspan="2"><h3>Upload Files</h3><br></td>
                   		</tr>
                   		<!--begin -->
                   		<table id="content1_1"  style="display:none" width="99%"  border="0">
                   		<tr>
                    		<td>How many photos will you upload:</td>
                    		<td><input name="photosCal_1" type="text" id="photosCal_1" size="2" maxlength="2" value="1" class="smallInput"/>
                                <a href="javascript:sndReq_1();">创建上传操作</a>
							</td>
                   		</tr>
                   		<tr>
                    		<td>选择图片:</td>
                    		<td><div id="divId_1"><div></td>
                   		</tr>
                   		</table>
                        <!--content1_2 -->
                   		<table id="content1_2" width="99%"  border="0" >
                   		<tr>
                    		<td>选择GPX文件:</td>
                    		<td><input type="file" name="GPSSelect" class="button2"/></td>
                   		</tr>
                   		<tr>
                    		<td>您要上传多少张图片:</td>
                    		<td><input name="photosCal_2" type="text" id="photosCal_2" size="2" maxlength="2" value="1" class="smallInput"/>
                                <a href="javascript:sndReq_2();">创建上传操作</a>
							</td>
                   		</tr>
                   		<tr>
                    		<td>选择图片:</td>
                    		<td><div id="divId_2"><div></td>
                   		</tr>
                   		</table>
                        <!--content1_3 -->
                   		<table id="content1_3"  style="display:none" width="99%"  border="0">
                   		<tr>
                    		<td>选择GPX文件:</td>
                    		<td><input type="file" name="GPSSelect_3" class="button2"/></td>
                   		</tr>
                   		</table>
                        <!--end -->
                   		<tr align="right">
                    		<td><input type="hidden" name="max_file_size" value="100000"></td>
                    		<td><input type="submit" name="FileUpload" value="上传" onmouseover="this.className='button1'" onmouseout="this.className='button'" class="button"/></td>
                   		</tr>

                   	</table>
</form>

<table width="99%"  border="0" cellspacing="1" cellpadding="4">
                    	<tr>
                    		<td colspan="2"><h3>下载样例文件以供测试</h3></td>
                   		</tr>
                        <tr>
                                <td class=contenttopl width=25%>1. GPX文件和普通图片:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent9 onclick="ShowHide('content9');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content9>
                    		<a href="images/a/agpx.xml" target="_blank">GPX文件 下载</a><br><br>
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
                                <td class=contenttopl width=25%>2. GPS图片:</td>
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
                   	    	<td class=contenttopl width=25%>2.  支持 & FAQ & 论坛:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent11 onclick="ShowHide('content11');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content11>
                            <a href="http://www.easywms.com/easywms/?q=en/taxonomy/term/14" target="_blank">支持 & FAQ</a><br><br>
                            <a href="http://www.easywms.com/easywms/?q=en/forum/10" target="_blank">论坛</a>
							</DIV>
							 <DIV id=mcontent11>&nbsp;</DIV>
							</td>
                   		</tr>
                        <tr>
                    		<td colspan="2"><h3>&nbsp; </h3></td>
                   		</tr>
                    		<td colspan="2" align="center" class="foot">
                                访客:
     <? include_once'counter/counter.php'; $style=0; style($style); ?>
     &nbsp; &nbsp;
	 <image src="images/im_smile.gif"  border="0"><br>
	 <a href="http://www.easywms.com">Copyright &copy; EasyWMS 2006-2007 </a>
				</td>
                   		</tr>
</table>


</body>
</html>