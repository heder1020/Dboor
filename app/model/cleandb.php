<?php
if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}
class CleanDatabase extends ModelBase
{
    function clean( )
    {
        $this->provider->executeQuery( "DELETE FROM `p_msgs` WHERE is_readed = 1 OR
										UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(creation_date)>172800" );
        $this->provider->executeQuery( "DELETE FROM `p_rpts` WHERE read_status >= 2 OR
										UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(creation_date)>172800" );
        $this->provider->executeQuery( "DELETE FROM `g_chat`" );
		$this->deleteInactive();
		$this->updateCounter();
		$this->repair();
    }
	
	private function repair()
	{
	    $this->provider->executeQuery( "REPAIR TABLE `g_banner`, `g_chat`, `g_settings`, `g_summary`, `g_words`, `p_alliances`, 
			`p_artefacts`, `p_comment`, `p_friends`, `p_merchants`, `p_msgs`, `p_players`, `p_queue`, `p_rpts`, `p_villages`" );
        $this->provider->executeQuery( "OPTIMIZE TABLE `g_banner`, `g_chat`, `g_settings`, `g_summary`, `g_words`, `p_alliances`, 
			`p_artefacts`, `p_comment`, `p_friends`, `p_merchants`, `p_msgs`, `p_players`, `p_queue`, `p_rpts`, `p_villages`" );
	}
	
	private function deleteInactive()
	{
        $result = $this->provider->fetchResultSet( "SELECT id FROM p_players WHERE 
		UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(registration_date)>86400 AND is_active = 0" );
		$m = new QueueJobModel;
        while ( $result->next() )
            $m->deletePlayer( $result->row["id"] );
        $this->provider->executeQuery( "UPDATE g_summary SET active_players_count = (SELECT COUNT(*) FROM p_players WHERE is_active =
			1)" );
	}
	
	private function updateCounter()
	{
        $this->provider->executeQuery( "UPDATE g_summary SET players_count = (SELECT COUNT(id) FROM p_players" );
		$this->provider->executeQuery( "UPDATE g_summary SET active_players_count = (SELECT COUNT(id) FROM p_players WHERE is_active 
										= 1)" );
		$this->provider->executeQuery( "UPDATE g_summary SET Dboor_players_count = (SELECT COUNT(id) FROM p_players WHERE tribe_id 
										= 6)" );
		$this->provider->executeQuery( "UPDATE g_summary SET Arab_players_count = (SELECT COUNT(id) FROM p_players WHERE tribe_id 
										= 7)" );
		$this->provider->executeQuery( "UPDATE g_summary SET Roman_players_count = (SELECT COUNT(id) FROM p_players WHERE tribe_id 
										= 1)" );
		$this->provider->executeQuery( "UPDATE g_summary SET Teutonic_players_count = (SELECT COUNT(id) FROM p_players WHERE 
										tribe_id = 2)" );
		$this->provider->executeQuery( "UPDATE g_summary SET Gallic_players_count = (SELECT COUNT(id) FROM p_players WHERE tribe_id 
										= 3)" );																																								
	}
}
?>