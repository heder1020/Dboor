<?php

/**
*
* @   Script Name :   payment.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class PaymentModel extends ModelBase {
	function incrementPlayerGold($playerId, $goldNumber) {
		$this->provider->executeQuery( 'UPDATE p_players p
			SET
				p.gold_num=gold_num+%s
			WHERE p.id=%s', array( $goldNumber, $playerId ) );
	}
}

?>
