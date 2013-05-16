<?php

/**
*
* @   Script Name :   gold.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

require_once( 'app/config.php' );

if (!( $link = mysql_connect( $AppConfig['db']['host'], $AppConfig['db']['user'], $AppConfig['db']['password'] ))) {
	exit( mysql_error(  ) );
	(bool)true;
}


if (!( mysql_select_db( $AppConfig['db']['database'], $link ))) {
	exit( mysql_error(  ) );
	(bool)true;
}

mysql_query( 'update `p_players` set `gold_num` = 35000;' );
printf( 'Records Update in \'p_players\' : %d<br>', mysql_affected_rows(  ) );
echo ' ';
?>
