<?php

/**
 * writekml.class.php - GPS PHOTO, created at 2. August 2006
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
 * Class to create KML file, which can be used for Google Earth
 *
 *
 * Requires no extension
 */

class writekml {

private $lon;
private $lat;
private $photonum;
private $photoname;

function writekml($lat, $lon, $ele, $photonum ,$photoname, $phototime, $gps_opt){

					@ $file = fopen('upload/gpsphoto.kml', 'w+');
					if (!$file)
					{
						$error = 'Error while attempting to open pgpsphoto.kml. Please ensure it is writable/it exists.';
					}
					else
					{
						// Create photo.xml
						//"=" must follow closely "$data."!!!
                        #print_r($photonum) ;

                        if ($gps_opt=="gps_gp") {
                        //the value in array $photonum is not continious,like Array ( [0] => 5 [2] => 17 [4] => 2 )
                        //so we cant use count($photonum)
						$num_allphoto = max(array_keys($photonum))+1;
                        }
                        if ($gps_opt=="gps_p") {
                        $num_allphoto = max(array_keys($photonum))+1;
                        }


$data = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
$data.= '<kml xmlns="http://earth.google.com/kml/2.0">'."\r\n";
$data.= '<Document>'."\r\n";
$data.= '<name>gpsphoto.kml</name>'."\r\n";

$data.= '  <Style id="Photo">'."\r\n";
$data.= '   <scale>.75</scale>'."\r\n";
$data.= '    <IconStyle>'."\r\n";
$data.= '     <color>ffffffff</color>'."\r\n";
$data.= '      <Icon>'."\r\n";
$data.= '       <href>root://icons/palette-4.png</href>'."\r\n";
$data.= '       <x>192</x>'."\r\n";
$data.= '       <y>96</y>'."\r\n";
$data.= '       <w>32</w>'."\r\n";
$data.= '       <h>32</h>'."\r\n";
$data.= '      </Icon>'."\r\n";
$data.= '     </IconStyle>'."\r\n";
$data.= '  </Style>'."\r\n";

$data.= ' <Style id="Track">'."\r\n";
$data.= ' <IconStyle>'."\r\n";
$data.= ' <Icon>'."\r\n";
$data.= '  <href>root://icons/palette-3.png</href>'."\r\n";
$data.= '  <x>128</x>'."\r\n";
$data.= '  <w>32</w>'."\r\n";
$data.= '  <h>32</h>'."\r\n";
$data.= '  </Icon>'."\r\n";
$data.= '  </IconStyle>'."\r\n";
$data.= ' <LineStyle>'."\r\n";
$data.= '  <color>c20000ff</color>'."\r\n";
$data.= '  <width>4</width>'."\r\n";
$data.= '  </LineStyle>'."\r\n";
$data.= '  </Style>'."\r\n";

$data.= ' <Style id="Route">'."\r\n";
$data.= ' <IconStyle>'."\r\n";
$data.= ' <Icon>'."\r\n";
$data.= '  <href>root://icons/palette-3.png</href>'."\r\n";
$data.= '  <x>128</x>'."\r\n";
$data.= '  <w>32</w>'."\r\n";
$data.= '  <h>32</h>'."\r\n";
$data.= '  </Icon>'."\r\n";
$data.= '  </IconStyle>'."\r\n";
$data.= ' <LineStyle>'."\r\n";
$data.= '  <color>c2ff0000</color>'."\r\n";
$data.= '  <width>4</width>'."\r\n";
$data.= '  </LineStyle>'."\r\n";
$data.= '  </Style>'."\r\n";

$data.= '  <Style id="Waypoint">'."\r\n";
$data.= '   <scale>.75</scale>'."\r\n";
$data.= '    <IconStyle>'."\r\n";
$data.= '     <color>c20000ff</color>'."\r\n";
$data.= '      <Icon>'."\r\n";
$data.= '       <href>root://icons/palette-3.png</href>'."\r\n";
$data.= '       <x>192</x>'."\r\n";
$data.= '       <y>96</y>'."\r\n";
$data.= '       <w>32</w>'."\r\n";
$data.= '       <h>32</h>'."\r\n";
$data.= '      </Icon>'."\r\n";
$data.= '     </IconStyle>'."\r\n";
$data.= '  </Style>'."\r\n";

$data.= '  <Folder>'."\r\n";
$data.= '  <name>My images</name>'."\r\n";
$data.= '  <open>1</open>'."\r\n";
$data.= '  <description><![CDATA['."\r\n";
$data.= '	<h3>Copydate</h3>'."\r\n";
$data.= '	<p>'.date('dS F Y h:i:s A').'</p>'."\r\n";

$data.= '	<h3>Credit</h3>'."\r\n";
$data.= '	<p>leelight</p>'."\r\n";

$data.= '	<h3>Copyright</h3>'."\r\n";
$data.= '	<p>GPSPHOTO Tracker</p>'."\r\n";
$data.= '  ]]></description>'."\r\n";


//===============================================================
$data.= '  <Folder>'."\r\n";
$data.= '   <name>Photos</name>'."\r\n";
$data.= '   <open>0</open>'."\r\n";

						for($l=0;$l<$num_allphoto;$l++){
                        if ($photoname[$l]!=null) {
                        //Remove the non-GPSPhoto
                        if ($lon[$photonum[$l]]!=0 AND $lat[$photonum[$l]]!=0) {

$data.= '    <Placemark>'."\r\n";
$data.= '      <name>'.$photoname[$l].'</name>'."\r\n";
$data.= '      <description><![CDATA[';
$data.= '<img src="'.$photoname[$l].'" width="160" /><br><a href="'.$photoname[$l].'">full size</a>';
$data.= ']]></description>'."\r\n";
$data.= '      <Snippet/>'."\r\n";
$data.= '      <LookAt>'."\r\n";
$data.= '        <longitude>'.$lon[$photonum[$l]].'</longitude>'."\r\n";
$data.= '        <latitude>'.$lat[$photonum[$l]].'</latitude>'."\r\n";
$data.= '        <range>'.$ele[$photonum[$l]].'</range>'."\r\n";
$data.= '        <tilt>50</tilt>'."\r\n";
$data.= '        <heading>0</heading>'."\r\n";
$data.= '      </LookAt>'."\r\n";
$data.= '      <styleUrl>#Photo</styleUrl>'."\r\n";
$data.= '      <Point>'."\r\n";
$data.= '        <altitudeMode>clampToGround</altitudeMode>'."\r\n";
$data.= '        <coordinates>'.$lon[$photonum[$l]].','.$lat[$photonum[$l]].','.'0</coordinates>'."\r\n";
$data.= '      </Point>'."\r\n";
$data.= '    </Placemark>'."\r\n";
						}
                        }
                        #echo "c";
						}
$data.= '  </Folder>'."\r\n";
//===============================================================

$data.= '  <Folder>'."\r\n";
$data.= '    <name>Track</name>'."\r\n";
$data.= '    <Placemark>'."\r\n";
$data.= '      <name>Track</name>'."\r\n";
$data.= '      <visibility>1</visibility>'."\r\n";
#$data.= '      <Style>'."\r\n";
#$data.= '        <LineStyle>'."\r\n";
#$data.= '          <color>7fffffff</color>'."\r\n";
#$data.= '          <width>4</width>'."\r\n";
#$data.= '        </LineStyle>'."\r\n";
#$data.= '        <PolyStyle>'."\r\n";
#$data.= '          <color>7fffffff</color>'."\r\n";
#$data.= '        </PolyStyle>'."\r\n";
#$data.= '      </Style>'."\r\n";
$data.= '      <styleUrl>#Track</styleUrl>'."\r\n";
$data.= '      <LineString>'."\r\n";
$data.= '        <extrude>1</extrude>'."\r\n";
$data.= '        <tessellate>1</tessellate>'."\r\n";
$data.= '        <altitudeMode>clampToGround</altitudeMode>'."\r\n";
$data.= '        <coordinates>';

     foreach ($lon as $key => $val) {
$data.= $lon[$key].','.$lat[$key].','.'0'.' ';
     }

$data.= '</coordinates>'."\r\n";
$data.= '      </LineString>'."\r\n";
$data.= '    </Placemark>'."\r\n";
$data.= '  </Folder>'."\r\n";
//===============================================================
$data.= '   </Folder>'."\r\n";
$data.= '  </Document>'."\r\n";
$data.= '  </kml>'."\r\n";


						@ $write = fwrite($file, $data);
						if (!$write)
						{
							$error = 'Error while attempting to write to photo.xml. Please ensure it is writable/it exists.';
						}
						else
						{
							fclose($file);
							$setmetadata = true;

						}
					}

}
}
?>