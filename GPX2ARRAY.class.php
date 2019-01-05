<?php

/**
 * GPX2ARRAY.class.php - GPS PHOTO
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
 * Class for parsing the corrdinate and timestamp information from GPX file
 *
 *
 * Requires no extension
 */


class GPXToArray {
//==================================================

//==================================================
  private $parser;
  private $con;
  private $table;
  private $recordset = array();
  private $content;
  private $value;
  private $field;
//==================================================
  public $arr_trkpt_ele = array();
  public $arr_trkpt_time = array();
  public $db_id;
  public $arr_trkpt_lat = array();
  public $arr_trkpt_lon = array();

  public $arr_latmax ;
  public $arr_latmin ;
  public $arr_lonmax ;
  public $arr_lonmin ;

  public $arr_latC ;
  public $arr_lonC ;

    function init()
    {
        $this->roottag = "";
        $this->curtag = &$this->roottag;
    }


  function GPXToArray() {
   $this->db_id=0;
   $this->init();
   $this->parser = xml_parser_create("UTF-8");
   xml_set_object($this->parser,$this);
   xml_set_element_handler($this->parser,"tag_open","tag_close");
   xml_set_character_data_handler($this->parser,"cdata");
  }


  function parse($data) {
  $content='';
   @xml_parse($this->parser, $data) or
   die(sprintf("XML Error: %s at line %d",
       xml_error_string(xml_get_error_code($this->parser)),
       xml_get_current_line_number($this->parser)));

  }


  function tag_open($parser, $tag, $attributes) {
   $parser;
   global $content;
   $content=$tag;
   switch ($tag) {
     case 'GPX': break;
     case 'METADATA': break;
     case 'BOUNDS':{
     $this->arr_latmax = $attributes['MAXLAT'];
     $this->arr_latmin = $attributes['MINLAT'];
     $this->arr_lonmax = $attributes['MAXLON'];
     $this->arr_lonmin = $attributes['MINLON'];

     $this->arr_latC = ($this->arr_latmax+$this->arr_latmin)/2;
     $this->arr_lonC = ($this->arr_lonmax+$this->arr_lonmin)/2;

	 } break;
     case 'TRK': {
      }break;
	 case 'NAME': break;

     case 'TRKSEG': {
		}break;
     case 'TRKPT': {
     $this->db_id++;

     $this->arr_trkpt_lat[$this->db_id] = $attributes['LAT'];
     $this->arr_trkpt_lon[$this->db_id] = $attributes['LON'];
     //echo $this->db_id;
          }break;
     case 'ELE': {
          }break;
     case 'TIME': {
          }break;

  }//in TAG
}

  function cdata($parser, $cdata) {
   $parser;
   global $content;
   switch ($this->content) {
     case 'base64': {
       $this->value = base64_decode($cdata);
     } break;
     default: {
       $this->value = $cdata;
     }
   }
   if (!$content) {return;}
   if ($content=="ELE") { $this->arr_trkpt_ele [$this->db_id] = $this->value;}
   if ($content=="TIME") { $this->arr_trkpt_time [$this->db_id]= $this->value;}
  }


  function tag_close($parser, $tag) {
   $parser;
   global $content;
   $content = '';

   switch ($tag) {
     case 'GPX': break;
     case 'METADATA': break;
     case 'BOUNDS':{
	 } break;
     case 'TRK': {
      }break;
	 case 'NAME': break;

     case 'TRKSEG': {
		}break;
     case 'TRKPT': {

          }break;
     case 'ELE': {

          }break;
     case 'TIME': {

          }break;

  }//in TAG
  }
}



#$xmlparse = new GPXToArray();
#
#$gpx_filename = 'gpx.xml';
#$xml_file = @fopen($gpx_filename,'r') or exit();
#
#while (($data = fread($xml_file,4194304))) {
#  $xmlparse->parse($data);
#  //print_r($xmlparse->arr_trkpt_lat);
#  //print_r($xmlparse->arr_trkpt_lon);
#  //print_r($xmlparse->arr_trkpt_ele);
#  //print_r($xmlparse->arr_trkpt_time); //from 1 to n
#}
#
#
#fclose($xml_file);

?>

<?
class XMLFile
{
    public $parser;
    public $roottag;
    public $curtag;

    function XMLFile()
    {
        $this->init();
    }

    # Until there is a suitable destructor mechanism, this needs to be
    # called when the file is no longer needed.  This calls the clear_subtags
    # method of the root node, which eliminates all circular references
    # in the xml tree.
    function cleanup()
    {
        if (is_object( $this->roottag )) {
            $this->roottag->clear_subtags();
        }
    }

    function init()
    {
        $this->roottag = "";
        $this->curtag = &$this->roottag;
    }

    function create_root()
    {
        $null = 0;
        $this->roottag = new XMLTag($null);
        $this->curtag = &$this->roottag;
    }

    # read_xml_string
    # Same as read_file_handle, but you pass it a string.  Note that
    # depending on the size of the XML, this could be rather memory intensive.
    # Contributed July 06, 2001 by Kevin Howe
    function read_xml_string( $str )
    {
        $this->init();
        $this->parser = xml_parser_create("UTF-8");
        xml_set_object( $this->parser, $this );
        xml_set_element_handler( $this->parser, "_tag_open", "_tag_close" );
        xml_set_character_data_handler( $this->parser, "_cdata" );
        xml_parse( $this->parser, $str );
        xml_parser_free( $this->parser );
    }

    function read_file_handle( $fh )
    {
        $this->init();
        $this->parser = xml_parser_create("UTF-8");
        xml_set_object( $this->parser, $this );
        xml_set_element_handler( $this->parser, "_tag_open", "_tag_close" );
        xml_set_character_data_handler( $this->parser, "_cdata" );

        while( $data = fread( $fh, 4096 )) {
            if (!xml_parse( $this->parser, $data, feof( $fh ) )) {
                die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($this->parser)),
                    xml_get_current_line_number($this->parser)));
            }
        }

        xml_parser_free( $this->parser );
    }

    function write_file_handle( $fh, $write_header=1 )
    {
        if ($write_header) {
            fwrite( $fh, "<?xml version='1.0' encoding='UTF-8'?>\n" );
        }

        # Start at the root and write out all of the tags
        $this->roottag->write_file_handle( $fh );
    }

    ###### UTIL #######

    function _tag_open( $parser, $tag, $attributes )
    {
        #print "tag_open: $parser, $tag, $attributes\n";
        # If the current tag is not set, then we are at the root
        if (!is_object($this->curtag)) {
            $null = 0;
            $this->curtag = new XMLTag($null);
            $this->curtag->set_name( $tag );
            $this->curtag->set_attributes( $attributes );
        }
        else { # otherwise, add it to the tag list and move curtag
            $this->curtag->add_subtag( $tag, $attributes );
            $this->curtag = &$this->curtag->curtag;
        }
    }

    function _tag_close( $parser, $tag )
    {
        # Move the current pointer up a level
        $this->curtag = &$this->curtag->parent;
    }

    function _cdata( $parser, $data )
    {
        $this->curtag->add_cdata( $data );
    }
}


class XMLTag
{
    public $cdata;
    public $attributes;
    public $name;
    public $tags;
    public $parent;

    public $curtag;

        function XMLTag(&$parent)
    {
        if (is_object( $parent ))
        {
            $this->parent = &$parent;
        }
        $this->_init();
    }

    function _init()
    {
        $this->attributes = array();
        $this->cdata = '';
        $this->name = '';
        $this->tags = array();
    }
    function add_subtag($name, $attributes=0)
    {
        $tag = new XMLTag( $this );
        $tag->set_name( $name );
        if (is_array($attributes)) {
            $tag->set_attributes( $attributes );
        }
        $this->tags[] = &$tag;
        $this->curtag = &$tag;
    }

    function find_subtags_by_name( $name )
    {
        $result = array();
        $found=false;
        for($i=0;$i<$this->num_subtags();$i++) {
            if(strtoupper($this->tags[$i]->name)==strtoupper($name)) {
                $found=true;
                $array2return[]=&$this->tags[$i];
            }
        }
        if($found) {
            return $array2return;
        }
        else {
            return false;
        }
    }
        function clear_subtags()
    {
        # Traverse the structure, removing the parent pointers
        $numtags = sizeof($this->tags);
        $keys = array_keys( $this->tags );
        foreach( $keys as $k ) {
            $this->tags[$k]->clear_subtags();
            unset($this->tags[$k]->parent);
        }

        # Clear the tags array
        $this->tags = array();
        unset( $this->curtag );
    }

    function remove_subtag($index)
    {
        if (is_object($this->tags[$index])) {
            unset($this->tags[$index]->parent);
            unset($this->tags[$index]);
        }
    }

    function num_subtags()
    {
        return sizeof( $this->tags );
    }

    function add_attribute( $name, $val )
    {
        $this->attributes[strtoupper($name)] = $val;
    }

    function clear_attributes()
    {
        $this->attributes = array();
    }

    function set_name( $name )
    {
        $this->name = strtoupper($name);
    }

    function set_attributes( $attributes )
    {
        $this->attributes = (is_array($attributes)) ? $attributes : array();
    }

    function add_cdata( $data )
    {
        $this->cdata .= $data;
    }

    function clear_cdata()
    {
        $this->cdata = "";
    }
}
?>