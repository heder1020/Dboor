<?php

/**
*
* @   Script Name :   links.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class LinksModel extends ModelBase {
	function changePlayerLinks($playerId, $links) {
		$this->provider->executeQuery( 'UPDATE p_players p SET p.custom_links=\'%s\' WHERE p.id=%s', array( $links, $playerId ) );
	}
}

?>
