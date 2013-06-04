<?php
if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}
require( LIB_PATH . 'mysql.php' );
class ModelBase extends MysqlModel
{
    function ModelBase( )
    {
        parent::mysqlmodel();
        $this->provider->debug      = FALSE;
        $this->provider->properties = $GLOBALS['AppConfig']['db'];
    }
}
?>