<?php
$r3 = mysql_query( "SELECT * FROM p_players" );
while ( $row = mysql_fetch_array( $r3 ) ) {
    $id2 = $row['id'];
}
for ( $id = 1; $id <= $id2; $id++ ) {
    $r1 = mysql_query( "SELECT * FROM p_players WHERE id='$id' && is_blocked=0" );
    while ( $row = mysql_fetch_array( $r1 ) ) {
        $ip      = $row['last_ip'];
        $ids     = $row['id'];
        $agents2 = $row['my_agent_players'];
    }
    $result1 = mysql_query( "SELECT * FROM p_players WHERE name='admin'" );
    while ( $row = mysql_fetch_array( $result1 ) ) {
        $admin_ip = $row['last_ip'];
    }
    $agents2      = explode( ",", $agents2 );
    $agents2['0'] = explode( " ", $agents2['0'] );
    $agents2['1'] = explode( " ", $agents2['1'] );
    If ( $agents2['0']['1'] != NULL ) {
        $resulta = mysql_query( "SELECT * FROM `p_players` WHERE name='{$agents2['0']['1']}'" );
        while ( $row = mysql_fetch_array( $resulta ) ) {
            $agent1_ip = $row['last_ip'];
        }
    }
    If ( $agents2['1']['1'] != NULL ) {
        $resultb = mysql_query( "SELECT * FROM `p_players` WHERE name='{$agents2['4']['1']}'" );
        while ( $row = mysql_fetch_array( $resultb ) ) {
            $agent2_ip = $row['last_ip'];
        }
    }
    if ( $last_ip == $ip ) {
        if ( $last_ip != $agent1_ip ) {
            if ( $last_ip != $agent2_ip ) {
                if ( $ids != $ids2 ) {
                    if ( $last_ip != $admin_ip ) {
                        mysql_query( "update p_players SET is_blocked=1 WHERE id='$id'" ) or die( mysql_error() );
                        mysql_query( "update p_players SET is_blocked=1 WHERE id='$Tak'" ) or die( mysql_error() );
                        $result = mysql_query( "SELECT * FROM p_players WHERE id='$id'" );
                        while ( $row = mysql_fetch_array( $result ) ) {
                            $name = $row['name'];
                        }
                        $result = mysql_query( "SELECT * FROM p_players WHERE id='$Tak'" );
                        while ( $row = mysql_fetch_array( $result ) ) {
                            $name2 = $row['name'];
                        }
                        $rest      = mysql_query( "SELECT * FROM p_players WHERE player_type=2" );
                        $row       = mysql_fetch_assoc( $rest );
                        $nameadmin = $row['name'];
                        $idadmin   = $row['id'];
                        $subjects  = "بن شدن بازیکن";
                        $sendsmss  = "بازیکنان $name با آیدی $id و بازیکن $name2 با آیدی $Tak بدلیل مولتی اکانت بودن بن شدند - ip = $last_ip";
                        mysql_query( "INSERT INTO `p_msgs` (`from_player_id`, `to_player_id`, `from_player_name`, `to_player_name`, `msg_title`, `msg_body`, `creation_date`, `is_readed`, `delete_status`) VALUES( '$idadmin', '$idadmin', '$nameadmin', '$nameadmin', '$subjects', '$sendsmss', now(), 0, 0)" );
                        mysql_query( "UPDATE p_players SET new_mail_count=new_mail_count+1 where player_type=2" );
                        break;
                    }
                }
            }
        }
    }
}
?>