<?php

/**
*
* @   Script Name :   medals.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/


//Config Inc
include('./app/config.php');

// الإتصال بالقاعدة
$db_connect = mysql_connect($AppConfig['db']['host'],$AppConfig['db']['user'],$AppConfig['db']['password']);
mysql_select_db($AppConfig['db']['database'], $db_connect);


//تحديد الأسابيع
$q = "SELECT * FROM g_settings order by cur_week DESC LIMIT 0, 1";
   $result = mysql_query($q);
   if(mysql_num_rows($result)) {
       $row=mysql_fetch_assoc($result);
       $week=($row['cur_week']+1);
    } else {
        $week='1';
        }


// أوسمة اللاعبون


// وسام المطور للاعب
    $result = mysql_query("SELECT * FROM p_players WHERE id > 0 ORDER BY week_dev_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "1:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_players SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_dev_points > 0") or  die(mysql_error());
    }

// وسام المهاجم للاعب
    $result = mysql_query("SELECT * FROM p_players WHERE id > 0 ORDER BY week_attack_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "2:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_players SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_attack_points > 0") or  die(mysql_error());
    }

// وسام المدافع للاعب
    $result = mysql_query("SELECT * FROM p_players WHERE id > 0 ORDER BY week_defense_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "3:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_players SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_defense_points > 0") or  die(mysql_error());
    }

// وسام السارق للاعب
    $result = mysql_query("SELECT * FROM p_players WHERE id > 0 ORDER BY week_thief_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "4:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_players SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_thief_points > 0") or  die(mysql_error());
    }


// أوسمة التحالفات

// إضافة
if ($week=="1")
  {

mysql_query("UPDATE p_alliances SET medals='::'") or die(mysql_error());
  }

// وسام المطور للتحالف
    $result = mysql_query("SELECT * FROM p_alliances WHERE id > 0 ORDER BY week_dev_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "5:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_alliances SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_dev_points > 0") or  die(mysql_error());
    }

// وسام المهاجم للتحالف
    $result = mysql_query("SELECT * FROM p_alliances WHERE id > 0 ORDER BY week_attack_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "6:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_alliances SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_attack_points > 0") or  die(mysql_error());
    }

// وسام المدافع للتحالف
    $result = mysql_query("SELECT * FROM p_alliances WHERE id > 0 ORDER BY week_defense_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "7:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_alliances SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_defense_points > 0") or  die(mysql_error());
    }

// وسام السارق للتحالف
    $result = mysql_query("SELECT * FROM p_alliances WHERE id > 0 ORDER BY week_thief_points DESC Limit 10");
    $i=0;
     while($row = mysql_fetch_array($result))
{
    $i++;    
            $medal = "8:$i:$week";
            $id = $row['id'];
            mysql_query("UPDATE p_alliances SET medals=CONCAT_WS(',',  medals, '$medal') WHERE id='$id' AND week_thief_points > 0") or  die(mysql_error());
    }

// END Medals Con


// 4+ Come Week
mysql_query("UPDATE g_settings SET cur_week='$week'") or die(mysql_error());
// END Come Week

// 0 Players And Alliances Score
mysql_query("UPDATE p_players   SET week_dev_points='0',  week_attack_points='0', week_defense_points='0', week_thief_points='0'")  or die(mysql_error());
mysql_query("UPDATE p_alliances SET week_dev_points='0',  week_attack_points='0', week_defense_points='0', week_thief_points='0'")  or die(mysql_error());
// END 0 Score


echo '<p align="center"><font color="blue" size="5">Le medaglie sono stati distribuiti ai primi 10 giocatori</font></p>';
echo '<p align="center"><font color="blue" size="5">Le medaglie sono state distribuite alle prime 10 alleanze</font></p>';
//echo '<p align="center"><font color="blue" size="5"> تم تحديث الأسبوع </font></p>';
//echo '<p align="center"><font color="blue" size="5"> تم تصفير نقاط اللاعبين </font></p>';
//echo '<p align="center">&nbsp;</p>';
/*echo '<p align="center"><b><font color="red"><a target="_blank" href="http://www.ts-war.com">
<span style="text-decoration: none" lang="ar-eg"><font color="#FF0000">جميع الحقوق محفوظة 
</font></span><font color="#FF0000"><span style="text-decoration: none">©<span lang="ar-eg"> 
ل</span></span></font><span lang="ar-eg"  style="text-decoration: none"><font color="#FF0000">أخوكم 
سنيري</font></span></a></font></b></p>'; */
echo '<p align="center">&nbsp;</p>';
echo '<p align="center">&nbsp;</p>';
echo '<p class="f16" align="center">
<a href="village1.php"><font size="4" color="green">
<span style="text-decoration: none">» Continua!</span></font></a></p>';

// mysql close
mysql_close($db_connect);
?> 