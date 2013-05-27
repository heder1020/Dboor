<?php

/**
*
* @   Script Name :   chat.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class ChatModel extends ModelBase {
	function SendToChat($username, $id, $text) {
		$this->provider->executeQuery( 'INSERT INTO `g_chat` SET
			`username` 	= \'%s\',
			`userid` 	= \'%s\',
			`date` 		= \'%s\',
			`text` 		= \'%s\';', array( $username, $id, time(  ), $text ) );
	}

	function GetFromChat() {
		return $this->provider->fetchResultSet( 'SELECT * FROM `g_chat` ORDER BY `ID` DESC LIMIT 50;' );
	}

	function DeleteOldChat() {
		$count = $this->provider->fetchScalar( 'SELECT COUNT(*) FROM `g_chat` ;' );

		if (50 < $count) {
			$limit = $count - 50;
			$this->provider->executeQuery( 'DELETE FROM `g_chat` ORDER BY `ID` ASC LIMIT %s ;', array( $limit ) );
		}

	}
}

?>
