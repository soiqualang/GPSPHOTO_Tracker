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
                                <td  class=contenttopl width=25%>�������ʱ�����</td>
                    		<td class=contenttopr width=75% align=right><a id=xcontent1 onclick="ShowHide('content1');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content1>
                                ���ʱ�����: <image src="images/im_help.png"  border="0" onmouseover="tooltip('���ʱ�����','����: ','����Ƶ����ʱ�������ͼƬ�ĳ�Ƭʱ����GPX�ļ���ʱ���Ĳ�ֵ��ӵ����Сʱ������ͼƬ����ȡ��Ӧ������. <br>��������Դ�ֵ, Ĭ��ֵΪ120��.');" onmouseout="exit();">
                               <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							    <input name="maxtimediff" type="text" id="maxtimediff" size="3" value="120"  class="smallInput"/>
							    <select NAME="TEMP" onchange="document.FormsGpsphoto.maxtimediff.value =this.options[this.selectedIndex].value" class="button4"/>
							    <option value="120">��</option>
							    <option value="60">1 ����</option>
							    <option value="120">2 ����</option>
							    <option value="180">3 ����</option>
							    <option value></option>
							    </select>
                                                          </DIV>
							 <DIV id=mcontent1>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                                    <td class=contenttopl width=25%>����ʱ��</td>
                   		    <td class=contenttopr width=75% align=right><a id=xcontent2 onclick="ShowHide('content2');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
							<DIV id=content2>
ʱ��: <image src="images/im_help.png"  border="0" onmouseover="tooltip('ʱ��','����:','����Ƶ�ʱ�������������GPSװ�õ�ʱ���ֵ.������װ��ʹ�ò�ͬʱ�䣬UTC��׼ʱ�򵱵�ʱ��,�������ʹ���˴����ʱ������.3600��ʾһ��Сʱ��ʱ���ζ���ʱ�����GPSװ��һСʱ.<br>��ֵ��ʾ������ʱ��,��ֵ��ʾ�����ǰʱ��.<br>��������Դ�ֵ, Ĭ��ֵΪ0��.');" onmouseout="exit();">
                                <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    		<input name="timeoffset" type="text" id="timeoffset" size="8" maxlength="8" value="0" class="smallInput"/>
							    <select NAME="TEMP" onchange="document.FormsGpsphoto.timeoffset.value =this.options[this.selectedIndex].value" class="button4"/>
							    <option value="0">��</option>
							    <option value="3600">1 Сʱ</option>
							    <option value="3600*2">2 Сʱ</option>
							    <option value="3600*3">3 Сʱ</option>
							    <option value="3600*4">4 Сʱ</option>
							    <option value="3600*5">5 Сʱ</option>
							    <option value="3600*6">6 Сʱ</option>
							    <option value="3600*7">7 Сʱ</option>
							    <option value="3600*8">8 Сʱ</option>
							    <option value="3600*9">9 Сʱ</option>
							    <option value="3600*10">10 Сʱ</option>
							    <option value="3600*11">11 Сʱ</option>
							    <option value="3600*12">12 Сʱ</option>
							    <option value="-3600">-1 Сʱ</option>
							    <option value="-3600*2">-2 Сʱ</option>
							    <option value="-3600*3">-3 Сʱ</option>
							    <option value="-3600*4">-4 Сʱ</option>
							    <option value="-3600*5">-5 Сʱ</option>
							    <option value="-3600*6">-6 Сʱ</option>
							    <option value="-3600*7">-7 Сʱ</option>
							    <option value="-3600*8">-8 Сʱ</option>
							    <option value="-3600*9">-9 Сʱ</option>
							    <option value="-3600*10">-10 Сʱ</option>
							    <option value="-3600*11">-11 Сʱ</option>
							    <option value="-3600*12">-12 Сʱ</option>
							    <option value></option>
							    </select>
                                                         </DIV>
							 <DIV id=mcontent2>&nbsp;</DIV>
							</td>
                   		</tr>
                   		<tr>
                                  <td class=contenttopl width=25%>����ѡ��</td>
                    	          <td class=contenttopr width=75% align=right><a id=xcontent3 onclick="ShowHide('content3');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content3>
д��GPSԪ����: <image src="images/im_help.png"  border="0" onmouseover="tooltip('д��GPSԪ����','','�����������µİ���GPSԪ���ݵ�ͼƬ��ͼƬԭ�е�Ԫ���ݽ�������.');" onmouseout="exit();">
<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    		<input type="checkbox" name="gps_op" value="wr_gps" class="button3">GPS Exif Ԫ���ݽ���д�뵽ͼƬ��.<br><br>

                               ���Google Earth KML�ļ�: <image src="images/im_help.png"  border="0" onmouseover="tooltip('���Google Earth KML�ļ�','','������ʹ��GoogleEarth��KML�ļ�.');" onmouseout="exit();">
                    		<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="gps_op1" value="wr_kml" class="button3">Google Earth KML�ļ��������.<br>
                                </DIV>
							 <DIV id=mcontent3>&nbsp;</DIV>
                                </td>
                   		</tr>
                              <td class=contenttopl width=25%>׷�ٷ�ʽ: <image src="images/im_help.png"  border="0" onmouseover="tooltip('׷������:','���ս������: ','<br><br><image src=images/gpsphotoi.gif  border=0>');" onmouseout="exit();"></td>
                    	<td class=contenttopr width=75% align=right><a id=xcontent4 onclick="ShowHide('content4');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                  		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content4>
                                <input type="radio" name= "gps_opt"  value="gps_p" class="button3" onClick="show_tbl('content1_',3,1)" style="cursor:hand;">
                                 ����GPSͼƬ������û��GPX�ļ�����ֻ��ʹ��Google Map׷��GPSͼƬ��
                                 <br>
                                <input type="radio" name= "gps_opt"  value="gps_gp" class="button3" onClick="show_tbl('content1_',3,2)" style="cursor:hand;" CHECKED>
                                 ������ͨ��GPSͼƬ��GPX�ļ�������ʹ��Google Map������GPX�ļ�׷��ͼƬ��
                                 <br>
                                <input type="radio" name= "gps_opt"  value="gps_g" class="button3" onClick="show_tbl('content1_',3,3)" style="cursor:hand;">
                                 ��ֻ��GPX�ļ�����ֻ��ʹ��Google Map׷�ٴ��ļ���
                                  </DIV>
							 <DIV id=mcontent4>&nbsp;</DIV>
                                </td>
                   		</tr>
                   		<tr>
                    		<td><font class=notice>ע��: </font></td>
                    		<td><p class="intro"><font class=notice>
                    		���ڽ���һ������ʱ�¿�һ���µ������������ִ���µĲ�����
                    		����Google map���ܻ���ִ�����ʾ��
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
                                <a href="javascript:sndReq_1();">�����ϴ�����</a>
							</td>
                   		</tr>
                   		<tr>
                    		<td>ѡ��ͼƬ:</td>
                    		<td><div id="divId_1"><div></td>
                   		</tr>
                   		</table>
                        <!--content1_2 -->
                   		<table id="content1_2" width="99%"  border="0" >
                   		<tr>
                    		<td>ѡ��GPX�ļ�:</td>
                    		<td><input type="file" name="GPSSelect" class="button2"/></td>
                   		</tr>
                   		<tr>
                    		<td>��Ҫ�ϴ�������ͼƬ:</td>
                    		<td><input name="photosCal_2" type="text" id="photosCal_2" size="2" maxlength="2" value="1" class="smallInput"/>
                                <a href="javascript:sndReq_2();">�����ϴ�����</a>
							</td>
                   		</tr>
                   		<tr>
                    		<td>ѡ��ͼƬ:</td>
                    		<td><div id="divId_2"><div></td>
                   		</tr>
                   		</table>
                        <!--content1_3 -->
                   		<table id="content1_3"  style="display:none" width="99%"  border="0">
                   		<tr>
                    		<td>ѡ��GPX�ļ�:</td>
                    		<td><input type="file" name="GPSSelect_3" class="button2"/></td>
                   		</tr>
                   		</table>
                        <!--end -->
                   		<tr align="right">
                    		<td><input type="hidden" name="max_file_size" value="100000"></td>
                    		<td><input type="submit" name="FileUpload" value="�ϴ�" onmouseover="this.className='button1'" onmouseout="this.className='button'" class="button"/></td>
                   		</tr>

                   	</table>
</form>

<table width="99%"  border="0" cellspacing="1" cellpadding="4">
                    	<tr>
                    		<td colspan="2"><h3>���������ļ��Թ�����</h3></td>
                   		</tr>
                        <tr>
                                <td class=contenttopl width=25%>1. GPX�ļ�����ͨͼƬ:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent9 onclick="ShowHide('content9');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content9>
                    		<a href="images/a/agpx.xml" target="_blank">GPX�ļ� ����</a><br><br>
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
                                <td class=contenttopl width=25%>2. GPSͼƬ:</td>
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
                   	    	<td class=contenttopl width=25%>2.  ֧�� & FAQ & ��̳:</td>
                    	    <td class=contenttopr width=75% align=right><a id=xcontent11 onclick="ShowHide('content11');"><img src="images/minimize.png" alt="minimize"></a></td>
                   		</tr>
                   		<tr>
                    		<td class="contenttext" colspan=2>
                    		<DIV id=content11>
                            <a href="http://www.easywms.com/easywms/?q=en/taxonomy/term/14" target="_blank">֧�� & FAQ</a><br><br>
                            <a href="http://www.easywms.com/easywms/?q=en/forum/10" target="_blank">��̳</a>
							</DIV>
							 <DIV id=mcontent11>&nbsp;</DIV>
							</td>
                   		</tr>
                        <tr>
                    		<td colspan="2"><h3>&nbsp; </h3></td>
                   		</tr>
                    		<td colspan="2" align="center" class="foot">
                                �ÿ�:
     <? include_once'counter/counter.php'; $style=0; style($style); ?>
     &nbsp; &nbsp;
	 <image src="images/im_smile.gif"  border="0"><br>
	 <a href="http://www.easywms.com">Copyright &copy; EasyWMS 2006-2007 </a>
				</td>
                   		</tr>
</table>


</body>
</html>