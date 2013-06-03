<?php

/**
*
* @   Script Name :   cleandb.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class CleanDatabase extends ModelBase
{
	function clean( )
	{
		mysql_query("DELETE FROM `p_msgs` WHERE is_readed = 1");
		mysql_query("DELETE FROM `p_rpts` WHERE read_status >= 2");
	}
}

?>