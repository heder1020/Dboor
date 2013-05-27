<?php

/**
*
* @   Script Name :   base.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

require( LIB_PATH . 'mysql.php' );
class ModelBase extends MysqlModel {
	function ModelBase() {
		parent::mysqlmodel(  );
		$this->provider->debug = FALSE;
		$this->provider->properties = $GLOBALS['AppConfig']['db'];
	}
}

?>
