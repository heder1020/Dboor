<?php

/**
*
* @   Script Name :   chat.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'chat.php' );
require_once( MODEL_PATH . 'wordsfilter.php' );
class GPage extends SecureGamePage {
	var $chats = null;
	var $Filter = NULL;

	function GPage() {
		parent::securegamepage(  );
		$this->viewFile = 'chat.phtml';
		$this->contentCssClass = 'player';
	}

	function load() {
		parent::load(  );
		$this->Filter = new FilterWordsModel(  );
		$m = new ChatModel(  );

		if (( $this->isPost(  ) && isset( $_POST['text'] ) )) {
			$text = stripslashes( htmlspecialchars( trim( $_POST['text'] ) ) );

			if ($text != '') {
				$m->SendToChat( $this->data['name'], $this->player->playerId, $text );
			}
		}

		$m->DeleteOldChat(  );
		$this->chats = $m->GetFromChat(  );
		$m->dispose(  );
	}
}

$p = new GPage(  );
$p->run(  );
?>
