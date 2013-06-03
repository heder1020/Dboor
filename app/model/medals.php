<?php

/**
*
* @   Script Name :   medals.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class Medals extends ModelBase
{
	function setWeeklyMedals( )
    {
        require_once( MODEL_PATH . 'statistics.php' );
		$week = mysql_query("SELECT `cur_week` FROM `g_settings`");
		$week = mysql_fetch_row($week);
        $week = $week['0'];
        $keyArray = array(
             'week_dev_points' => 1,
            'week_attack_points' => 2,
            'week_defense_points' => 3,
            'week_thief_points' => 4 
        );
        $sm       = new StatisticsModel();
        foreach ( $keyArray as $columnName => $index ) {
            $result = $sm->getTop10( TRUE, $columnName );
            
            if ( $result != NULL ) {
                $i = 0;
                
                while ( $result->next() ) {
                    $medal = $index . ':' . ++$i . ':' . $week;
                    $this->provider->executeQuery( 'UPDATE p_players SET medals=CONCAT_WS(\',\', medals, \'%s\') WHERE id=%s', array(
                         $medal,
                        $result->row[ 'id' ] 
                    ) );
                }
            }
            
            $result = $sm->getTop10( FALSE, $columnName );
            
            if ( $result != NULL ) {
                $i = 0;
                
                while ( $result->next() ) {
                    $medal = $index + 4 . ':' . ++$i . ':' . $week;
                    $this->provider->executeQuery( 'UPDATE p_alliances SET medals=CONCAT_WS(\',\', medals, \'%s\') WHERE id=%s', array(
                         $medal,
                        $result->row[ 'id' ] 
                    ) );
                }
                
                continue;
            }
        }
        
        $this->provider->executeQuery( 'UPDATE p_players   SET week_dev_points=0, week_attack_points=0, week_defense_points=0, week_thief_points=0' );
        $this->provider->executeQuery( 'UPDATE p_alliances SET week_dev_points=0, week_attack_points=0, week_defense_points=0, week_thief_points=0' );
        $sm->dispose();
		$this->provider->executeQuery( "UPDATE `g_settings` SET `cur_week` = cur_week + '1'");
    }
	
}

?>