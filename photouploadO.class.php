<?php

/**
 * photouploadO.class.php - GPS PHOTO
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
 * Class to create upload operation on users demand, using Ajax
 *
 *
 * Requires no extension
 */

    if($_GET['photosCal']) {
    //Waiting the Creating Operation
        sleep(2);
        $photosnr = $_GET['photosCal'];

        for($i=0;$i<$photosnr;$i++){
        echo " <input type=\"file\" name=\"PHOTOSelect[".$i."]\" class=\"button2\"/><br/>";
       }
    }
?>
