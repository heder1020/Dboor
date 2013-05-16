<?php

/**
*
* @   Script Name :   notes.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

class NotesModel extends ModelBase {
	function changePlayerNotes($playerId, $notes) {
		$this->provider->executeQuery( 'UPDATE p_players p SET p.notes=\'%s\' WHERE p.id=%s', array( $notes, $playerId ) );
	}
}

?>
