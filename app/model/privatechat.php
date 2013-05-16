<?php

/**
*
* @   Script Name :   privatechat.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

class PrivateChatModel extends ModelBase {
	function SendToChat($from, $playerId, $avatar, $to, $to_id, $message) {
		$user = $this->provider->fetchScalar( 'SELECT `avatar` FROM `p_players` WHERE `id` = \'%s\';', array( $to_id ) );
		$this->provider->executeQuery( 'INSERT INTO `privatechat` SET
		`from` 		= \'%s\',
		`from_id` 	= \'%s\',
		`from_img` 	= \'%s\',
		`to` 		= \'%s\',
		`to_id` 	= \'%s\',
		`to_img` 	= \'%s\',
		`message` 	= \'%s\',
		`sent` 		= NOW();', array( $from, $playerId, $avatar, $to, $to_id, $user, $message ) );
	}

	function GetFromChat($playerId) {
		$privatechat = $this->provider->fetchResultSet( 'SELECT * FROM `privatechat` WHERE (`to_id` = \'%s\' AND recd = 0) ORDER BY `id` ASC;', array( $playerId ) );
		$this->provider->executeQuery( 'UPDATE `privatechat` SET `recd` = 1 WHERE `to_id` = \'%s\' AND `recd` = 0;', array( $playerId ) );
		return $privatechat;
	}
}

?>
