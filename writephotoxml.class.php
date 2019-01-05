<?php

/**
 * writephotoxml.class.php - GPS PHOTO
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
 * Class to create GML XML file, which storing the coordinate and other description
 * about the photos
 *
 *
 * Requires no extension
 */

class writephotoxml {

public $lon;
public $lat;
public $photonum;
public $photoname;

function writephotoxml($lat, $lon, $photonum ,$photoname, $phototime, $gps_opt){

					@ $file = fopen('upload/photo.xml', 'w+');
					if (!$file)
					{
						$error = 'Error while attempting to open photo.xml. Please ensure it is writable/it exists.';
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

						$data = '<markers>'."\r\n";
						for($l=0;$l<$num_allphoto;$l++){
                        if ($photoname[$l]!=null) {
                        //Remove the non-GPSPhoto
                        if ($lon[$photonum[$l]]!=0 AND $lat[$photonum[$l]]!=0) {

						$data.= '<marker html="&lt;div id=&quot;infotitle&quot;&gt;'.$photoname[$l].'&lt;/div&gt;&lt;div id=&quot;infodesc&quot;&gt;'.'&lt;br/&gt;';
						$data.= 'Photo was captured at '.$phototime[$l].'&lt;br/&gt;&lt;/div&gt;';
						$data.= '&lt;div id=&quot;infoimg&quot;&gt;&lt;a href=&apos;upload/'.$photoname[$l].'&apos; title=&apos;Click for a full size view&apos; target=&apos;_blank&apos;&gt;';
						$data.= '&lt;img src=&apos;upload/'.$photoname[$l].'&apos; width=&apos;160&apos; border=&apos;0&apos; height=&apos;120&apos; /&gt;&lt;/a&gt;&lt;/div&gt;" ';
						$data.= 'lng="'.$lon[$photonum[$l]].'" ' ;
						$data.= 'lat="'.$lat[$photonum[$l]].'" />'."\r\n";
						$data.= "\r\n";
						}
                        }
                        #echo "c";
						}
						$data.= '</markers>'."\r\n";

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