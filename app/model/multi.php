<?php

/**
 *
 * @   Script Name :   multi.php
 * @   Author      :   NIKO28
 * @   Skype       :   nicolo3767
 * @   Project     :   DBOOR Full Decoded
 *
 **/

if (!defined('INSIDE')) {
    die("Hacking attempt");
}

class Multi extends ModelBase
{
    function ban()
    {
        $admin_ip = mysql_query("SELECT  `last_ip` FROM  `p_players` WHERE  `id` =1");
        $admin_ip = mysql_fetch_row($admin_ip);
        $admin_ip = $admin_ip['0'];
        $player   = mysql_query("SELECT last_ip, id, my_agent_players FROM p_players WHERE is_blocked=0");
        
        while ($row = mysql_fetch_assoc($player)) {
            
            $id      = $row['id'];
            $last_ip = $row['last_ip'];
            $agents  = $row['my_agent_players'];
            
            if ($last_ip != $admin_ip) {
                $multi = mysql_query("SELECT id FROM `p_players` WHERE last_ip='$last_ip' AND id != $id");
                if ($multi != NULL) {
                    if (mysql_num_rows($multi) > 0) {
                        if ($agents != '') {
                            $agents  = explode(",", $agents);
                            $agents1 = explode(" ", $agents[0]);
                            $agents1 = $agents[1];
                            if (isset($agents[1])) {
                                $agents2 = explode(" ", $agents[1]);
                                $agents2 = $agents[1];
                            }
                        }
                        if (isset($agents1) && isset($agents2)) {
                            mysql_query("UPDATE p_players SET `is_blocked` = '1' WHERE `last_ip`= '$last_ip' AND name != '$agents1' AND name != 
								  '$agents2' && id!= 1");
                        } elseif (isset($agents1)) {
                            mysql_query("UPDATE p_players SET `is_blocked` = '1' WHERE ``last_ip`= '$last_ip' AND name != '$agents1' AND id != 1");
                        } else {
                            mysql_query("UPDATE p_players SET `is_blocked` = '1' WHERE `last_ip`= '$last_ip' AND id != 1");
                        }
                    }
                }
            }
        }
        
    }
}
?>