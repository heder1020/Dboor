<?php
if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}
class Evasione extends ModelBase
{
    function aggiungi( $villageid , $playerid )
    {
        $this->provider->executeQuery( "UPDATE `p_villages` SET `evasione` = evasione+1 WHERE `id` = ".$villageid );
		$this->provider->executeQuery( "UPDATE `p_players` SET `gold_num` = gold_num-5 WHERE id =".$playerid );
    }
	
}
?>