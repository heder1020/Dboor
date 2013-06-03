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
		mysql_query("DELETE FROM `g_chat`");
		mysql_query("REPAIR TABLE `g_banner`, `g_chat`, `g_settings`, `g_summary`, `g_words`, `p_alliances`, `p_artefacts`, 
					`p_comment`, `p_friends`, `p_merchants`, `p_msgs`, `p_players`, `p_queue`, `p_rpts`, `p_villages`" );
		mysql_query("OPTIMIZE TABLE `g_banner`, `g_chat`, `g_settings`, `g_summary`, `g_words`, `p_alliances`, `p_artefacts`, 
					`p_comment`, `p_friends`, `p_merchants`, `p_msgs`, `p_players`, `p_queue`, `p_rpts`, `p_villages`" );
	}
}

?>