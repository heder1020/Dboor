<?php

/**
*
* @   Script Name :   over.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'profile.php' );
class GPage extends GamePage {
	var $playerData = null;

	function GPage() {
		parent::gamepage(  );
		$this->viewFile = 'over.phtml';
		$this->contentCssClass = 'messages';
	}

	function load() {
		parent::load(  );

		if (!$this->globalModel->isGameOver(  )) {
			exit( 0 );
			return null;
		}

		$m = new ProfileModel(  );
		$this->playerData = $m->getWinnerPlayer(  );
		$m->dispose(  );
	}
}

$p = new GPage(  );
$p->run(  );
?>
