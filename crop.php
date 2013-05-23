<?php

/**
*
* @   Script Name :   crop.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
class GPage extends SecureGamePage {

	function GPage() {
		parent::securegamepage(  );
		$this->viewFile = 'crop.phtml';
		$this->contentCssClass = 'plus';


	}

	function load() {
		parent::load(  );
		$this->selectedTabIndex = (( ( ( isset( $_GET['t'] ) && is_numeric( $_GET['t'] ) ) && 0 <= intval( $_GET['t'] ) ) && intval( 		
										 $_GET['t'] ) <= 2 ) ? intval( $_GET['t'] ) : 0);
		$time = 0;
		$tasks = $this->queueModel->tasksInQueue;

		if (isset( $tasks[constant( 'QS_PLUS' . ( 1 ) )] )) {
			$time = $tasks[constant( 'QS_PLUS' . ( 1 ) )][0]['remainingSeconds'];
		}
		
		if ( $time == 0 ){
			header("location: plus.php");
		}
		
	}
}

$p = new GPage(  );
$p->run(  );
?>