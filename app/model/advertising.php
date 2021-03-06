<?php
if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}
class AdvertisingModel extends ModelBase
{
    function Advertising( $post, $type )
    {
        if ( $type == 'add' ) {
            $this->provider->executeQuery( 'INSERT INTO `g_banner` SET
			`name` = \'%s\',
			`url` = \'%s\',
			`cat` = \'%s\',
			`image` = \'%s\',
			`type` = \'%s\',
			`date` = \'%s\',
			`visit` = \'%s\',
			`view` = \'%s\'
			 ;', array(
                 $post['name'],
                $post['url'],
                $post['cat'],
                $post['image'],
                $post['type'],
                time(),
                0,
                0 
            ) );
            return null;
        }
        if ( $type == 'edit' ) {
            $this->provider->executeQuery( 'UPDATE `g_banner` SET
			`name` = \'%s\',
			`url` = \'%s\',
			`cat` = \'%s\',
			`image` = \'%s\',
			`type` = \'%s\'
			WHERE `ID` = \'%s\'
			 ;', array(
                 $post['name'],
                $post['url'],
                $post['cat'],
                $post['image'],
                $post['type'],
                $post['ID'] 
            ) );
        }
    }
    function DeleteAdvertising( $advID )
    {
        $this->provider->executeQuery( 'DELETE FROM `g_banner` WHERE `ID` = \'%s\' ;', array(
             $advID 
        ) );
    }
    function GetBanner( $place )
    {
        $row = $this->provider->fetchRow( 'SELECT * FROM `g_banner` WHERE `cat` = \'%s\' ORDER BY RAND() LIMIT 1;', array(
             $place 
        ) );
        $this->provider->executeQuery( 'UPDATE `g_banner`SET `view` = `view`+1 WHERE `ID` = \'%s\' ;', array(
             $row['ID'] 
        ) );
        return $row;
    }
    function GoToBanner( $ID )
    {
        $row = $this->provider->fetchRow( 'SELECT * FROM `g_banner` WHERE `ID` = \'%s\' LIMIT 1;', array(
             $ID 
        ) );
        $this->provider->executeQuery( 'UPDATE `g_banner`SET `visit` = `visit`+1 WHERE `ID` = \'%s\' ;', array(
             $row['ID'] 
        ) );
        return $row['url'];
    }
    function GetAdvertisings( $pageIndex, $pageSize )
    {
        return $this->provider->fetchResultSet( 'SELECT * FROM `g_banner` LIMIT %s,%s;', array(
             $pageIndex * $pageSize,
            $pageSize 
        ) );
    }
    function getAdvertisingCount( )
    {
        return $this->provider->fetchScalar( 'SELECT COUNT(*) FROM `g_banner` ;' );
    }
}
?>