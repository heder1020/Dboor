<?php
define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'evasione.php' );
class GPage extends SecureGamePage
{
	var $error = '';

    function GPage( )
    {
        parent::securegamepage();
        $this->viewFile        = 'evasione.phtml';
        $this->contentCssClass = 'plus';
    }
    function load( )
    {
        parent::load();
		if ( isset( $_POST['Submit'] ) ) {
			if( $this->data['gold_num'] < 5 ){
				$this->error = 'Non hai abbastanza Gold!';	
			} else {
				$m = new Evasione();
				$m->aggiungi( $this->data['selected_village_id'], $this->player->playerId );
				$this->redirect( 'evasione.php' );
			}
		}
    }
}
$p = new GPage();
$p->run();
?>