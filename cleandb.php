<?php
define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'cleandb.php' );
class GPage extends SecureGamePage
{
    var $isAdmin = FALSE;
    function GPage( )
    {
        parent::securegamepage();
        $this->viewFile        = 'cleandb.phtml';
        $this->contentCssClass = 'player';
    }
    function load( )
    {
        parent::load();
        $this->isAdmin = $this->data['player_type'] == PLAYERTYPE_ADMIN;
        if ( !$this->isAdmin ) {
            exit( 0 );
            return null;
        }
        if ( isset( $_POST['Submit'] ) ) {
            $cd = new CleanDatabase();
            $cd->clean();
        }
    }
}
$p = new GPage();
$p->run();
?>